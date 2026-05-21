<?php

use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// TODO: Temporary placeholder route to prevent test redirects from crashing
// Route::get('items/{id}', function() { return ''; })->name('items.detail');

// Define a route that explicitly passes the report parameter in the URL
// Route::post('laporan/{laporan}/komentar', [KomentarController::class, 'store'])->name('komentar.store');

// Your existing resource route remains unchanged
// Route::resource('komentar', KomentarController::class)->except(['store']);