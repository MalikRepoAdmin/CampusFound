<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/beranda', function () {
    return view('items.beranda');
})->name('beranda');
Route::get('/success', function () {
    return view('items.success');
})->name('success');
Route::get('/addLaporan', function () {
    return view('items.addLaporan');
})->name('addLaporan');
Route::get('/jelajahi', function () {
    return view('items.jelajahi');
})->name('jelajahi');
Route::get('/barang/{id}', function ($id) {
    return view('items.detail');
})->name('barang.detail');
Route::get('/profile', function () {
    return view('items.profile');
})->name('profile');

/**
 * Edit Barang Routes
 */ 
// This middleware will break demo
Route::middleware('auth')->group(function () {

    Route::get('/items/{laporan}/editbarang', [LaporanController::class, 'edit'])->name('items.editBarang');
    Route::put('/items/{laporan}', [LaporanController::class, 'update'])->name('items.update');
});


/**
 * Auth Routes
 */ 
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/**
 * Resources Routes (for unit test)
 */
Route::resource('laporan', \App\Http\Controllers\LaporanController::class);
Route::resource('komentar', \App\Http\Controllers\KomentarController::class);