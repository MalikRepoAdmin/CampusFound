<?php

use App\Http\Controllers\LaporanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// TODO: Temporary placeholder route to prevent test redirects from crashing
Route::get('items/{id}', function() { return ''; })->name('items.detail');
