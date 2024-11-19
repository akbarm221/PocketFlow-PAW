<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Auth;
use Illuminate\Http\Request;
use App\Models\Pemasukan;
use Carbon\Carbon;

class PemasukanController extends Controller
{
    /**
     * Menampilkan daftar pemasukan berdasarkan filter yang dipilih
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Mengambil filter dari input request, default 'all'
        $filter = $request->input('filter', 'all');
        
        // Query pemasukan, hanya untuk user yang login
        $query = Pemasukan::where('user_id', auth()->id());

        // Filter berdasarkan minggu
        if ($filter === 'week') {
            $query->whereBetween('tanggal', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        }
        // Filter berdasarkan bulan
        elseif ($filter === 'month') {
            $query->whereMonth('tanggal', Carbon::now()->month);
        }
        // Filter seluruh data tanpa batasan tahun (untuk 'all')
        elseif ($filter === 'all') {
            // Tidak ada filter tahun, ambil seluruh data
            // Hanya pastikan data yang diambil adalah milik pengguna yang login
        }

        // Ambil data pemasukan sesuai dengan filter
        $pemasukan = $query->get();

        // Mengembalikan tampilan dengan data pemasukan dan filter yang diterapkan
        return view('pemasukan.index', compact('pemasukan', 'filter'));
    }

    /**
     * Menampilkan form untuk menambahkan pemasukan baru
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Ambil semua kategori dari database
// Ambil kategori milik user yang login
    $kategori = Kategori::where('user_id', Auth::id())->get();

       

        // Kirim data kategori ke view
        return view('pemasukan.create', compact('kategori'));
    }

    /**
     * Menyimpan pemasukan baru ke dalam database
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id', // Validasi kategori_id yang harus ada dalam tabel kategori
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // Simpan data pemasukan dengan kategori_id dan user_id
        Pemasukan::create([
            'user_id' => auth()->id(), // Menyimpan ID user yang sedang login
            'jumlah' => $request->jumlah,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit pemasukan yang sudah ada
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
{
    // Ambil pemasukan berdasarkan ID dan pastikan milik user yang login
    $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);

    // Ambil kategori milik user yang login
    $kategori = Kategori::where('user_id', auth()->id())->get();

    // Kirim data pemasukan dan kategori ke view
    return view('pemasukan.edit', compact('pemasukan', 'kategori'));
}

    /**
     * Memperbarui pemasukan yang sudah ada
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'deskripsi' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        // Cari pemasukan berdasarkan ID dan pastikan hanya pemilik yang bisa update
        $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);

        // Update data pemasukan
        $pemasukan->update($request->all());

        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil diperbarui!');
    }

    /**
     * Menghapus pemasukan yang ada
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        // Cari pemasukan berdasarkan ID dan pastikan hanya pemilik yang bisa menghapus
        $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);

        // Hapus data pemasukan
        $pemasukan->delete();

        return redirect()->route('pemasukan.index')->with('success', 'Data pemasukan berhasil dihapus!');
    }

    /**
     * Menampilkan detail pemasukan berdasarkan ID
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Ambil pemasukan berdasarkan ID dan pastikan hanya milik user yang login
        $pemasukan = Pemasukan::where('user_id', auth()->id())->findOrFail($id);

        return view('pemasukan.show', compact('pemasukan'));
    }
}
