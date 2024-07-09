<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class JasaController extends Controller
{
    public function movein()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Move-in service available',
            'data' => Service::where('type', 'movein')->get()
        ], 200);
    }

    public function packin()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Pack-in service available',
            'data' => Service::where('type', 'packin')->get()
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $jasa = Service::findOrFail($id);
        $jasa->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Service updated successfully!',
            'data' => $jasa
        ], 200);
    }

    public function delete($id)
    {
        $jasa = Service::findOrFail($id);
        $jasa->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Service deleted successfully!'
        ], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $jasa = Service::create($validatedData);

        return response()->json([
            'status' => 'success',
            'message' => 'Service booked successfully!',
            'data' => $jasa
        ], 201);
    }

    public function paymentMovein()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Payment for move-in service',
            'data' => Service::where('type', 'movein')->where('user_id', Auth::id())->get()
        ], 200);
    }

    public function paymentPackin()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Payment for pack-in service',
            'data' => Service::where('type', 'packin')->where('user_id', Auth::id())->get()
        ], 200);
    }

    public function history()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Service history',
            'data' => Service::where('user_id', Auth::id())->get()
        ], 200);
    }
}
