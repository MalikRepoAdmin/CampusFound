<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KlaimController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/tentang-kami', function () {
    return view('items.tentangKami');
})->name('tentang-kami');


/**
 * Pages/items Routes
 */
Route::middleware('auth')->group(function (){

    Route::get('/beranda',[LaporanController::class, 'indexBeranda'])->name('beranda');

    Route::get('/addLaporan', [LaporanController::class, 'create'])->name('addLaporan');
    Route::post('/addLaporan', [LaporanController::class, 'store']);

    Route::get('/jelajahi', [LaporanController::class, 'index'])->name('jelajahi');

    // 'id' parameter name is exactly the same as parameter name in show() method
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.detail');
    Route::post('/laporan/{id}', [KomentarController::class, 'store'])->name('komentar.store');

    // Delete Komentar
    Route::delete('/laporan/{komentar}', [KomentarController::class, 'destroy'])->name('komentar.delete');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

    // Edit Laporan
    Route::get('/editBarang/{laporan}', [LaporanController::class, 'edit'])->name('editBarang');
    Route::put('/editBarang/{laporan}', [LaporanController::class, 'update']);

    // Resolve Laporan
    Route::patch('/profile/{laporan}', [LaporanController::class, 'resolveStatus'])->name('resolveLaporan');

    // Klaim Routes
    Route::get('/klaim/{laporan}', [KlaimController::class, 'create'])->name('klaim');
    Route::post('/klaim/{laporan}', [KlaimController::class, 'store']);
    Route::delete('/klaim/{klaim}', [KlaimController::class, 'destroy'])->name('klaim.cancel');
});


/**
 * Auth Routes
 */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


/**
 * Resources Routes (for unit test)
 */
Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
Route::resource('komentar', \App\Http\Controllers\KomentarController::class);
