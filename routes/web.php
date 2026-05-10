<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('/items/{id}/editbarang', function ($id) { return view('items.editBarang'); })->name('items.editBarang');
Route::delete('/items/{id}', function ($id) {  return redirect()->route('profile'); });
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

