<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
        ]);

        $booking = Booking::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Booking created successfully!',
            'data' => $booking
        ], 201);
    }
}
