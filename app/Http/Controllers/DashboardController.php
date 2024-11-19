<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();

        // Menentukan waktu berdasarkan pilihan filter
        $filter = $request->input('filter', 'all'); // Default 'all' (seluruh data)
        $startDate = null;
        $endDate = Carbon::now()->endOfDay();

        if ($filter === 'week') {
            $startDate = Carbon::now()->startOfWeek()->startOfDay(); // Awal minggu (Senin, pukul 00:00)
            $endDate = Carbon::now()->endOfWeek()->endOfDay();       // Akhir minggu (Minggu, pukul 23:59:59)
        } elseif ($filter === 'month') {
            $startDate = Carbon::now()->startOfMonth()->startOfDay(); // Awal bulan
    $endDate = Carbon::now()->endOfMonth()->endOfDay();       // Akhir bulan
        } elseif ($filter === 'all') {
            // Filter seluruh data
            $startDate = null; // Tidak membatasi tanggal awal
            $endDate = null;   // Tidak membatasi tanggal akhir
        }

        // Ambil data pemasukan sesuai filter
        $pemasukanQuery = Pemasukan::where('user_id', $userId);
        if ($startDate && $endDate) {
            $pemasukanQuery->whereBetween('tanggal', [$startDate, $endDate]);
        }
        $totalPemasukan = $pemasukanQuery->sum('jumlah');

        // Ambil data pengeluaran sesuai filter
        $pengeluaranQuery = Pengeluaran::where('user_id', $userId);
        if ($startDate && $endDate) {
            $pengeluaranQuery->whereBetween('tanggal', [$startDate, $endDate]);
        }
        $totalPengeluaran = $pengeluaranQuery->sum('jumlah');

        // Ambil top 5 pengeluaran berdasarkan kategori
        $topPengeluaran = Pengeluaran::where('pengeluaran.user_id', $userId)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('pengeluaran.tanggal', [$startDate, $endDate]);
            })
            ->join('kategori', 'pengeluaran.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama', DB::raw('SUM(pengeluaran.jumlah) as total'))
            ->groupBy('kategori.id', 'kategori.nama')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Pastikan data tidak null
        $totalPemasukan = $totalPemasukan ?: 0;
        $totalPengeluaran = $totalPengeluaran ?: 0;

        // Mengembalikan view dashboard dengan data
        return view('dashboard.index', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'topPengeluaran',
            'filter'
        ));
    }
}
