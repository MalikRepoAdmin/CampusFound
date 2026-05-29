<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Retrieve All Laporan and Klaim of Authenticated User
     */
    public function index()
    {
        $user = User::where('id_user', Auth::id())->with(['laporans.barangs', 'klaims.laporans'])->first();

        $laporanCount = $user->laporans->count();
        $klaimCount = $user->klaims->count();

        $nameWordCount = str($user->nama)->wordCount() > 1 ? 2 : 1;

        // return view laporan.index means it looking for views/laporan/index.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.profile', compact('user', 'laporanCount', 'klaimCount', 'nameWordCount'));
    }

}
