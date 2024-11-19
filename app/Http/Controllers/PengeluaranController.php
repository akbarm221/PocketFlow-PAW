<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengeluaran;
use App\Models\Kategori;

class PengeluaranController extends Controller
{
    /**
     * Menampilkan daftar pengeluaran sesuai dengan user yang login.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all'); // Filter: all, week, month
        $query = Pengeluaran::where('user_id', Auth::id()); // Hanya data milik user yang login

        if ($filter === 'week') {
            $query->whereBetween('tanggal', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('tanggal', now()->month);
        }

        $pengeluaran = $query->with('kategori')->latest()->get(); // Ambil data dengan relasi kategori

        return view('pengeluaran.index', compact('pengeluaran', 'filter'));
    }

    /**
     * Menampilkan form untuk menambah pengeluaran baru.
     */
    public function create()
    {
        $kategori = Kategori::where('user_id', Auth::id())->get(); // Hanya kategori milik user
        return view('pengeluaran.create', compact('kategori'));
    }

    /**
     * Menyimpan data pengeluaran baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'nullable|exists:kategori,id',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        Pengeluaran::create([
            'user_id' => Auth::id(), // Set user_id sesuai user yang login
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit data pengeluaran.
     */
    public function edit($id)
    {
        // Ambil pemasukan berdasarkan ID dan pastikan milik user yang login
        $pengeluaran = Pengeluaran::where('user_id', auth()->id())->findOrFail($id);
    
        // Ambil kategori milik user yang login
        $kategori = Kategori::where('user_id', auth()->id())->get();
    
        // Kirim data pemasukan dan kategori ke view
        return view('pengeluaran.edit', compact('pengeluaran', 'kategori'));
    }
    /**
     * Memperbarui data pengeluaran yang ada di database.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'nullable|exists:kategori,id',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id); // Cek kepemilikan
        $pengeluaran->update([
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil diperbarui!');
    }

    /**
     * Menghapus data pengeluaran.
     */
    public function destroy($id)
    {
        $pengeluaran = Pengeluaran::where('user_id', Auth::id())->findOrFail($id); // Cek kepemilikan
        $pengeluaran->delete();

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil dihapus!');
    }
}
