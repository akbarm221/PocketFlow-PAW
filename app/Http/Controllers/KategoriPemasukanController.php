<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KategoriPemasukan;

class KategoriPemasukanController extends Controller
{
    /**
     * Menampilkan halaman pembuatan kategori pemasukan dengan kategori milik user yang login.
     */
    public function create()
    {
        // Ambil kategori pemasukan milik user yang login
        $kategori = KategoriPemasukan::where('user_id', Auth::id())->get();

        // Kirim data kategori ke view
        return view('pemasukan.create', compact('kategori'));
    }

    /**
     * Menyimpan kategori pemasukan baru untuk user yang login.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_pemasukan,nama,NULL,id,user_id,' . Auth::id(),
        ]);

        KategoriPemasukan::create([
            'nama' => $request->nama,
            'user_id' => Auth::id(), // Tambahkan user_id
        ]);

        return redirect()->back()->with('success', 'Kategori pemasukan berhasil ditambahkan!');
    }
}
