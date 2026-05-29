<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
     * Display a listing of the resource for 'beranda'
     */
    public function indexBeranda()
    {
        $laporans = Laporan::with(['users', 'barangs'])->latest()->paginate(3);
        $laporansCount = Laporan::count();
        $laporansActiveCount = Laporan::where('status_laporan', 'active')->count();
        $laporansResolvedCount = Laporan::where('status_laporan', 'resolved')->count();
        $resolvedPercentage = null;

        if ($laporansCount > 0 && $laporansResolvedCount > 0) {
            $percentage = ($laporansResolvedCount / $laporansCount) * 100;
            $resolvedPercentage = number_format($percentage, 2);
        } else {
            $resolvedPercentage = 0;
        }

        // return view laporan.index means it looking for views/laporan/index.blade.php
        // TODO: define the view route according to frontend inside views/
        return view('items.beranda', compact(
            'laporans',
            'laporansCount', 
            'laporansActiveCount', 
            'laporansResolvedCount',
            'resolvedPercentage',
        ));
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
                $request->validate([
                    'foto_barang' => 'image|mimes:jpg,png,jpeg|max:2048',
                ], [
                    'foto_barang.image' => 'File yang anda Upload tidak valid, hanya boleh upload gambar',
                    'foto_barang.mimes' => 'Format Gambar tidak didukung',
                    'foto_barang.max' => 'Ukuran File maksimal 2MB',
                ]);

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
        $laporan = Laporan::with(['users', 'barangs', 'komentars.users', 'klaims.users'])->findOrFail($id);

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

        $laporan = $laporan->load('barangs');

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
            'nama_barang' => 'nullable|string',
            'kategori_laporan' => 'nullable|in:lost,found',
            'deskripsi' => 'nullable|string',
            'lokasi' => 'nullable|string',
            'foto_barang' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'foto_barang.image' => 'File yang anda Upload tidak valid, hanya boleh upload gambar',
            'foto_barang.mimes' => 'Format Gambar tidak didukung',
            'foto_barang.max' => 'Ukuran File maksimal 2MB',
        ]);

        // foto_barang is optional, if it exist and not null then store into storage and get the path
        if ($request->hasFile('foto_barang')) {
            // Delete the old file if it exists
            if ($laporan->foto_barang) {
                Storage::delete($laporan->foto_barang);
            }

            $validated['foto_barang'] = $request->file('foto_barang')->store('photos', config('filesystems.default'));
        }

        // start update operation
        $laporan->update($validated);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('laporan.detail', $laporan->id_laporan)->with('status', 'Laporan Berhasil diperbarui!');
    }

    /**
     * Only Update the status to 'resolved'
     */
    public function resolveStatus(Laporan $laporan)
    {
        // Validate that the user who update the laporan is the owner of the laporan
        if ($laporan->fk_id_user !== Auth::id()) {
            abort(403, 'Anda Tidak Memiliki Akses ke Laporan ini');
        }

        // start update operation
        $laporan->update(['status_laporan' => 'resolved']);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('laporan.detail', $laporan->id_laporan)->with('status', 'Status Laporan Berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        // Laporan shouldn't be destroyed because laporan must be auditaable
    }
}
