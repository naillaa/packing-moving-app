<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Welcome to the home page',
            'data' => null
        ], 200);
    }

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Welcome to the dashboard',
            'data' => null
        ], 200);
    }
}
