<?php

// app/Http/Controllers/LayoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Pastikan hanya pengguna yang terautentikasi yang bisa mengakses
    }

    public function showLayout()
    {
        $loggedInUser = Auth::user();  // Ambil data pengguna yang sedang login
        return view('layouts.app', compact('loggedInUser'));  // Kirim data ke view
    }
}
