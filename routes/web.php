<?php

use App\Http\Controllers\GoalController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route untuk halaman login
Route::get('/', function () {
    return view('auth.login');
});

// Halaman login dan registrasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->middleware('guest');
Route::post('/register', [AuthController::class, 'register'])->middleware('guest');

// Route forget password
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [AuthController::class, 'processForgotPassword'])->name('forgot-password.process');

// Route logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Group untuk halaman-halaman yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('pemasukan', PemasukanController::class);
    Route::resource('pengeluaran', PengeluaranController::class);
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::resource('goals', GoalController::class)->except(['show']);
    Route::put('/goals/{id}/toggle', [GoalController::class, 'toggleCompletion'])->name('goals.toggle');
    
    Route::get('/pemasukan', [pemasukanController::class, 'index'])->name('pemasukan.index');
    Route::get('/pemasukan/create', [pemasukanController::class, 'create'])->name('pemasukan.create');
    Route::post('/pemasukan', [pemasukanController::class, 'store'])->name('pemasukan.store');
    Route::get('/pemasukan/{id}/edit', [pemasukanController::class, 'edit'])->name('pemasukan.edit');
    Route::put('/pemasukan/{id}', [pemasukanController::class, 'update'])->name('pemasukan.update');
    Route::delete('/pemasukan/{id}', [pemasukanController::class, 'destroy'])->name('pengeluaran.destroy');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{id}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{id}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
});
