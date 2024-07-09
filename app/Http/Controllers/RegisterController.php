<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'fullname' => 'required|max:255',
            'phone' => 'required',
            'password' => 'required|min:3|max:255|confirmed',
        ]);

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Register berhasil, silahkan login!',
            'data' => [
                'email' => $request->email,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
            ]
        ], 201);
    }
}
