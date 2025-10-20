<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'kamar_id' => 'required|exists:kamar,id',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after_or_equal:checkin_date',
        ]);

        Booking::create([
            'hotel_id' => $request->hotel_id,
            'user_id' => auth()->id(), // jika user login
            'property_id' => $request->property_id,
            'kamar_id' => $request->kamar_id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dibuat!');
    }
}

