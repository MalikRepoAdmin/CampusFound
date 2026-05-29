<?php

namespace App\Http\Controllers;

use App\Models\Klaim;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KlaimController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create(Laporan $laporan)
    {
        // return view laporan.create means it looking for views/laporan/create.blade.php
        return view('items.klaim', compact('laporan'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    function store(Request $request, Laporan $laporan)
    {

        // Validation
        $request->validate([
            'ciri' => 'required|max:1000',
        ], [
            'ciri.required' => 'Ciri Khusus Barang sebaiknya diisi untuk memperkuat klaim anda',
        ]);

        // Using Transaction
        DB::transaction(function () use ($laporan, $request) {

            // foto_bukti is optional, if it exist and not null then store into storage and get the path
            $path = null;
            if ($request->hasFile('foto_bukti')) {
                $request->validate([
                    'foto_bukti' => 'image|mimes:jpg,png,jpeg|max:2048',
                ], [
                    'foto_bukti.image' => 'File yang anda Upload tidak valid, hanya boleh upload gambar',
                    'foto_bukti.mimes' => 'Format Gambar tidak didukung',
                    'foto_bukti.max' => 'Ukuran File maksimal 2MB',
                ]);

                $path = $request->file('foto_bukti')->store('photos/bukti', config('filesystems.default'));
            }

            $klaim = Klaim::create([
                'ciri' => $request->ciri,
                'foto_bukti' => $path,

                'fk_id_user' => Auth::id(),
                'fk_id_laporan' => $laporan->id_laporan,
            ]);
        });

        return redirect()->route('laporan.detail', $laporan->id_laporan)->with('success_klaim', 'Klaim Anda berhasil diSubmit!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Klaim $klaim)
    {

        // laporan.show means it looking for views/laporan/show.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.detail', compact('klaim'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Klaim $klaim)
    {

        // Validate that the user who delete the komentar is the owner of the komentar
        if ($klaim->fk_id_user !== \Illuminate\Support\Facades\Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus komentar ini.');
        }

        $klaim->delete();

        return redirect()->route('profile')->with('status', 'Klaim berhasil dibatalkan!');
    }
}
