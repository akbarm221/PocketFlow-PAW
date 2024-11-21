<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPengeluaran;

class KategoriPengeluaranController extends Controller
{
    /**
     * Menampilkan halaman pembuatan kategori pengeluaran dengan kategori milik user yang login.
     */
    public function create()
    {
        // Ambil kategori pengeluaran milik user yang login
        $kategori = KategoriPengeluaran::where('user_id', Auth::id())->get();

        // Kirim data kategori ke view
        return view('pengeluaran.create', compact('kategori'));
    }

    /**
     * Menyimpan kategori pengeluaran baru untuk user yang login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_pengeluaran,nama,NULL,id,user_id,' . Auth::id(),
        ]);

        KategoriPengeluaran::create([
            'nama' => $request->nama,
            'user_id' => Auth::id(), // Tambahkan user_id
        ]);

        return redirect()->back()->with('success', 'Kategori pengeluaran berhasil ditambahkan!');
    }
}
