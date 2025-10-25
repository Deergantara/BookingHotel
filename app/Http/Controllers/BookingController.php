<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TipeKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Menampilkan form booking
    public function create(Request $request)
{
    $propertyId = $request->query('property_id');
    $property = \App\Models\Property::find($propertyId);

    if (!$property) {
        abort(404, 'Property not found');
    }

    // Nilai default (bisa kamu ubah sesuai kebutuhan)
    $checkin = now()->format('Y-m-d');
    $checkout = now()->addDay()->format('Y-m-d');
    $guests = 1; // default 1 tamu

    return view('booking.create', compact('property', 'checkin', 'checkout', 'guests'));
}




    public function store(Request $request)
    {
        $request->validate([
            'tipe_kamar_id' => 'required|exists:tipe_kamars,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $tipeKamar = TipeKamar::findOrFail($request->tipe_kamar_id);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'property_id' => $tipeKamar->property_id,
            'kamar_id' => $tipeKamar->id,
            'status' => 'pending',
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
        ]);

        return redirect()->route('booking.store', $booking->id)
                         ->with('success', 'Kamar berhasil dipesan!');
    }
}
