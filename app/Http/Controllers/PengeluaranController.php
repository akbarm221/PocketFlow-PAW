<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
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

        $pengeluaran = $query->orderBy('tanggal', 'desc')->get();

        return view('pengeluaran.index', compact('pengeluaran', 'filter'));
    }

     /**
     * Menampilkan form untuk membuat pengeluaran baru.
     */
    public function create()
    {
        // Ambil kategori pengeluaran milik user yang login
        $kategori = KategoriPengeluaran::where('user_id', Auth::id())->get();

        // Kirim data kategori ke view
        return view('pengeluaran.create', compact('kategori'));
    }

    /**
     * Menyimpan pengeluaran baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'kategori_pengeluaran_id' => 'required|exists:kategori_pengeluaran,id', // Validasi kategori_pengeluaran_id
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // Simpan data pengeluaran dengan kategori_pengeluaran_id dan user_id
        Pengeluaran::create([
            'user_id' => auth()->id(), // Menyimpan ID user yang sedang login
            'jumlah' => $request->jumlah,
            'kategori_pengeluaran_id' => $request->kategori_pengeluaran_id,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data pengeluaran berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit pengeluaran yang sudah ada.
     */
    public function edit($id)
    {
        // Ambil pengeluaran berdasarkan ID dan pastikan milik user yang login
        $pengeluaran = Pengeluaran::where('user_id', auth()->id())->findOrFail($id);

        // Ambil kategori pengeluaran milik user yang login
        $kategori = KategoriPengeluaran::where('user_id', auth()->id())->get();

        // Kirim data pengeluaran dan kategori ke view
        return view('pengeluaran.edit', compact('pengeluaran', 'kategori'));
    }

    /**
     * Memperbarui pengeluaran yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'kategori_pengeluaran_id' => 'required|exists:kategori_pengeluaran,id', // Validasi kategori_pengeluaran_id
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // Cari pengeluaran berdasarkan ID dan pastikan hanya pemilik yang bisa update
        $pengeluaran = Pengeluaran::where('user_id', auth()->id())->findOrFail($id);

        // Update data pengeluaran
        $pengeluaran->update([
            'jumlah' => $request->jumlah,
            'kategori_pengeluaran_id' => $request->kategori_pengeluaran_id,
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
