<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporans = Laporan::with(['users', 'barangs'])->latest()->paginate(6);

        // return view laporan.index means it looking for views/laporan/index.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.jelajahi', compact('laporans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view laporan.create means it looking for views/laporan/create.blade.php
        return view('items.addLaporan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'kategori_laporan' => 'required|in:lost,found',
            'nama_barang' => 'required',
            'kategori_barang' => 'required',
        ], [
            'kategori_laporan.required' => 'Kategori Laporan wajib dipilih',
            'nama_barang.required' => 'Nama Barang wajib diisi',
            'kategori_barang.required' => 'Kategori Barang wajib dipilih, atau pilih "lainnya"',
        ]);

        // Validation: IF the kategori_laporan is 'found' then lokasi must be included
        if ($request['kategori_laporan'] === 'found') {
            $request->validate([
                'lokasi' => 'required'
            ], 
            ['lokasi.required' => 'Lokasi wajib dipilih jika menemukan barang']);
        }


        // Using Transaction, Laporan and Barang would be recorded into database at once
        DB::transaction(function () use ($request) {
            $laporan = Laporan::create([
                'kategori_laporan' => $request->kategori_laporan,
                'status_laporan' => 'active',
                'deskripsi' => $request->deskripsi,

                'fk_id_user' => Auth::id(),
            ]);

            // foto_barang is optional, if it exist and not null then store into storage and get the path
            $path = null;
            if ($request->hasFile('foto_barang')) {
                $path = $request->file('foto_barang')->store('photos', config('filesystems.default'));
            }

            // Create Barang then store along with Laporan
            $laporan->barangs()->create([
                'nama_barang' => $request->nama_barang, 
                'kategori_barang' => $request->kategori_barang, 
                'lokasi' => $request->lokasi,

                // save the foto_barang file path into database
                'foto_barang' => $path,
            ]);

        });
        
        // TODO: define the redirect route according to frontend inside views/
        return redirect()->back()->withInput([])->with('success', 'Laporan Anda berhasil diSubmit!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $laporan = Laporan::with(['users', 'barangs', 'komentars.users'])->findOrFail($id);

        // laporan.show means it looking for views/laporan/show.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.detail', compact('laporan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        // Validate that the user who edit the laporan is the owner of the laporan
        if ($laporan->fk_id_user !== Auth::id()) {
            abort(403, 'Anda Tidak Memiliki Akses ke Laporan ini');
        }


        // laporan.edit means it looking for views/laporan/edit.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.editBarang', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        // Validate that the user who update the laporan is the owner of the laporan
        if ($laporan->fk_id_user !== Auth::id()) {
            abort(403, 'Anda Tidak Memiliki Akses ke Laporan ini');
        }


        $validated = $request->validate([
            'kategori_laporan' => 'sometimes|in:lost,found',
            'deskripsi' => 'sometimes|string',
        ]);

        // start update operation
        $laporan->update($validated);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('items.detail', $laporan->id_laporan)->with('status', 'Laporan Berhasil diperbarui!');
    }

    /**
     * Only Update the status to either 'active' or 'resolved'
     */
    public function updateStatus(Request $request, Laporan $laporan)
    {
        // Validate that the user who update the laporan is the owner of the laporan
        if ($laporan->fk_id_user !== Auth::id()) {
            abort(403, 'Anda Tidak Memiliki Akses ke Laporan ini');
        }


        $validated = $request->validate([
            'status_laporan' => 'required',
        ]);

        // start update operation
        $laporan->update($validated);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('items.detail', $laporan->id_laporan)->with('status', 'Status Laporan Berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        // Laporan shouldn't be destroyed because laporan must be auditaable
    }
}
