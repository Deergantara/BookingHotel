<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Property;
use App\Models\TipeKamar;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'property_id' => 'required|exists:properties,id',
                'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
                'checkin_date' => 'required|date|after:today',
                'checkout_date' => 'required|date|after:checkin_date',
                'guests' => 'required|integer|min:1|max:10',
                'guest_name' => 'required|string|max:255',
                'guest_email' => 'required|email',
                'guest_phone' => 'required|string|max:20',
                'total_price' => 'required|numeric'
            ]);

            // Simpan booking ke database
            $booking = Booking::create([
                'property_id' => $validated['property_id'],
                'tipe_kamar_id' => $validated['tipe_kamar_id'],
                'checkin_date' => $validated['checkin_date'],
                'checkout_date' => $validated['checkout_date'],
                'guests' => $validated['guests'],
                'guest_name' => $validated['guest_name'],
                'guest_email' => $validated['guest_email'],
                'guest_phone' => $validated['guest_phone'],
                'total_price' => $validated['total_price'],
                'status' => 'pending'
            ]);

            // Generate order ID
            $orderId = 'BOOK-' . $booking->id . '-' . time();

            // Integrasi dengan Midtrans
            \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
            \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $validated['total_price'],
                ],
                'customer_details' => [
                    'first_name' => $validated['guest_name'],
                    'email' => $validated['guest_email'],
                    'phone' => $validated['guest_phone'],
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Update booking dengan order_id
            $booking->update(['order_id' => $orderId]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_id' => $orderId,
                'message' => 'Booking berhasil dibuat'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function success(Request $request)
    {
        $orderId = $request->query('order_id');
        // Update status booking menjadi success
        Booking::where('order_id', $orderId)->update(['status' => 'success']);

        return view('booking.success', compact('orderId'));
    }

    public function pending(Request $request)
    {
        $orderId = $request->query('order_id');
        return view('booking.pending', compact('orderId'));
    }

    public function failed(Request $request)
    {
        $orderId = $request->query('order_id');
        // Update status booking menjadi failed
        Booking::where('order_id', $orderId)->update(['status' => 'failed']);

        return view('booking.failed', compact('orderId'));
    }
}
