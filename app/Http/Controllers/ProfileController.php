<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Auth::user()
        ], 200);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'required',
            'password' => 'nullable|min:3|max:255|confirmed',
        ]);

        $user = Auth::user();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile updated successfully!',
            'data' => $user
        ], 200);
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Profile deleted successfully!'
        ], 200);
    }
}
