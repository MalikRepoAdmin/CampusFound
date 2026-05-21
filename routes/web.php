<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/success', function () {
    return view('items.success');
})->name('success');
Route::get('/profile', function () {
    return view('items.profile');
})->name('profile');
Route::get('/tentang-kami', function () {
    return view('items.tentangKami');
})->name('tentang-kami');

/**
 * Edit Barang Routes
 */ 
// This middleware will break demo
Route::middleware('auth')->group(function () {

    Route::get('/items/{laporan}/editbarang', [LaporanController::class, 'edit'])->name('items.editBarang');
    Route::put('/items/{laporan}', [LaporanController::class, 'update'])->name('items.update');
});


/**
 * Pages/items Routes
 */ 
Route::middleware('auth')->group(function (){

    Route::get('/beranda', function () { return view('items.beranda'); })->name('beranda');

    Route::get('/addLaporan', [LaporanController::class, 'create'])->name('addLaporan');
    Route::post('/addLaporan', [LaporanController::class, 'store']);

    Route::get('/jelajahi', [LaporanController::class, 'index'])->name('jelajahi');

    // 'laporan' parameter name is exactly the same as parameter name in show() method
    Route::get('/laporan/{id}', [LaporanController::class, 'show'])->name('laporan.detail');
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