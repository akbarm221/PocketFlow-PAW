<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Menampilkan halaman pembuatan kategori dengan kategori milik user yang login.
     */
    public function create()
    {
        // Ambil kategori milik user yang login
        $kategori = Kategori::where('user_id', Auth::id())->get();
        
        // Kirim data kategori ke view
        return view('pemasukan.create', compact('kategori'));
    }

    /**
     * Menyimpan kategori baru untuk user yang login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori,nama,NULL,id,user_id,' . Auth::id(),
        ]);

        Kategori::create([
            'nama' => $request->nama,
            'user_id' => Auth::id(), // Tambahkan user_id
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }
}
