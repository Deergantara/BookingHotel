<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Midtrans\Config;
use Midtrans\Snap;

class BookingController extends Controller
{
    /**
     * Menampilkan form booking
     * URL: /booking/{property}?checkin=...&checkout=...&total_guests=...&total_rooms=...&tipe_kamar_id=...
     */
    public function create(Property $property, Request $request)
    {
        // Validasi parameter dari URL
        $validated = $request->validate([
            'checkin' => 'required|date|after_or_equal:today',
            'checkout' => 'required|date|after:checkin',
            'total_guests' => 'required|integer|min:1|max:10',
            'total_rooms' => 'required|integer|min:1|max:5',
            'tipe_kamar_id' => 'nullable|exists:tipe_kamars,id',
        ]);

        // Load relasi yang dibutuhkan
        $property->load(['hotel', 'tipeKamars.kamars.bookings']);

        // Ambil data dari request
        $checkin = $validated['checkin'];
        $checkout = $validated['checkout'];
        $totalGuests = $validated['total_guests'];
        $totalRooms = $validated['total_rooms'];
        $selectedTipeKamarId = $request->tipe_kamar_id;

        // Hitung jumlah malam
        $checkinDate = Carbon::parse($checkin);
        $checkoutDate = Carbon::parse($checkout);
        $nights = $checkinDate->diffInDays($checkoutDate);

        // Filter tipe kamar yang tersedia di tanggal yang dipilih
        $availableRoomTypes = $property->tipeKamars->filter(function($tipeKamar) use ($checkin, $checkout, $totalRooms) {
            // Hitung kamar yang tersedia (tidak dibooking)
            $availableRooms = $tipeKamar->kamars->filter(function($kamar) use ($checkin, $checkout) {
                // Kamar harus berstatus tersedia
                if ($kamar->status !== 'tersedia') {
                    return false;
                }

                // Cek apakah kamar tidak memiliki booking yang overlap
                $hasOverlappingBooking = $kamar->bookings()
                    ->whereNotIn('status', ['cancelled', 'completed'])
                    ->where(function($query) use ($checkin, $checkout) {
                        $query->where('checkin_date', '<=', $checkout)
                              ->where('checkout_date', '>=', $checkin);
                    })
                    ->exists();

                return !$hasOverlappingBooking;
            });

            // Pastikan ada minimal sejumlah kamar yang dibutuhkan
            return $availableRooms->count() >= $totalRooms;
        });

        // Jika tidak ada kamar tersedia
        if ($availableRoomTypes->isEmpty()) {
            return redirect()
                ->route('property.show', $property->id)
                ->with('error', 'Maaf, tidak ada kamar tersedia untuk tanggal yang Anda pilih. Silakan pilih tanggal lain.');
        }

        $isLoggedIn = Auth::check();
        $user = Auth::user();

        return view('booking.create', [
            'property' => $property,
            'availableRoomTypes' => $availableRoomTypes,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'totalGuests' => $totalGuests,
            'totalRooms' => $totalRooms,
            'nights' => $nights,
            'selectedTipeKamarId' => $selectedTipeKamarId,
            'isLoggedIn' => $isLoggedIn,
            'user' => $user,
        ]);
    }

    /**
     * Menyimpan booking ke database
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'guests' => 'required|integer|min:1|max:10',
        ]);

        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk melakukan booking.');
        }

        // Load tipe kamar dengan relasi kamars dan bookings
        $tipeKamar = TipeKamar::with('kamars.bookings')->findOrFail($validated['tipe_kamar_id']);

        // Cari kamar yang tersedia
        $availableKamar = $tipeKamar->kamars->first(function($kamar) use ($validated) {
            // Kamar harus tersedia
            if ($kamar->status !== 'tersedia') {
                return false;
            }

            // Cek overlap booking
            $hasOverlappingBooking = $kamar->bookings()
                ->whereNotIn('status', ['cancelled', 'completed'])
                ->where(function($query) use ($validated) {
                    $query->where('checkin_date', '<=', $validated['checkout_date'])
                          ->where('checkout_date', '>=', $validated['checkin_date']);
                })
                ->exists();

            return !$hasOverlappingBooking;
        });

        // Jika tidak ada kamar tersedia
        if (!$availableKamar) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Maaf, kamar sudah tidak tersedia. Silakan pilih kamar lain atau tanggal berbeda.');
        }

        // Hitung total harga
        $checkin = Carbon::parse($validated['checkin_date']);
        $checkout = Carbon::parse($validated['checkout_date']);
        $nights = $checkin->diffInDays($checkout);
        $totalPrice = $tipeKamar->harga * $nights;

        // Buat payment record
        $payment = \App\Models\Payment::create([
            'midtrans_order_id' => 'ORDER-' . time() . '-' . Auth::id(),
            'price' => $totalPrice,
            'transaction_status' => 'pending',
        ]);

        // Buat booking
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $validated['property_id'],
            'kamar_id' => $availableKamar->id,
            'payment_id' => $payment->id,
            'checkin_date' => $validated['checkin_date'],
            'checkout_date' => $validated['checkout_date'],
            'status' => 'pending',
        ]);

        // Update status kamar menjadi dipesan
        $availableKamar->update(['status' => 'dipesan']);

        // Debug: Cek apakah booking dan payment berhasil dibuat
        \Log::info('Booking created:', [
            'booking_id' => $booking->id,
            'payment_id' => $payment->id,
            'user_id' => Auth::id()
        ]);

        // Debug: Cek redirect URL
        $redirectUrl = route('payment.createTransaction', $booking->id);
        \Log::info('Redirecting to:', ['url' => $redirectUrl]);

        // Redirect ke halaman pembayaran - INI YANG DIPERBAIKI
        return redirect()
            ->route('payment.createTransaction', $booking->id)
            ->with('success', 'Booking berhasil dibuat! Silakan lakukan pembayaran.');
    }

    /**
     * Menampilkan detail booking
     */
    public function show(Booking $booking)
    {
        // Pastikan user hanya bisa melihat booking miliknya sendiri
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Load relasi yang dibutuhkan
        $booking->load([
            'property.hotel',
            'kamar.tipeKamar',
            'payment',
            'user'
        ]);

        return view('booking.show', compact('booking'));
    }

    /**
     * Menampilkan daftar booking user
     */
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['property', 'kamar.tipeKamar', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('booking.index', compact('bookings'));
    }

    /**
     * Cancel booking
     */
    public function cancel(Booking $booking)
    {
        // Pastikan user yang cancel adalah pemilik booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk membatalkan booking ini.');
        }

        // Hanya bisa cancel jika status masih pending atau confirmed
        if (!in_array($booking->status, ['pending', 'confirmed'])) {
            return redirect()
                ->back()
                ->with('error', 'Booking tidak dapat dibatalkan.');
        }

        // Update status booking
        $booking->update(['status' => 'cancelled']);

        // Kembalikan status kamar menjadi tersedia
        if ($booking->kamar) {
            $booking->kamar->update(['status' => 'tersedia']);
        }

        // Update payment status jika ada
        if ($booking->payment) {
            $booking->payment->update(['transaction_status' => 'cancel']);
        }

        return redirect()
            ->route('booking.index')
            ->with('success', 'Booking berhasil dibatalkan.');
    }

    /**
     * Menampilkan konfirmasi booking
     */
    public function confirmation(Booking $booking)
    {
        $booking->load([
            'property.hotel',
            'kamar.tipeKamar',
            'payment',
            'user'
        ]);

        return view('booking.confirmation', compact('booking'));
    }
}
