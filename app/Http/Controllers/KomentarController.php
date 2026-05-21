<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $laporan = Laporan::with(['users', 'barangs', 'komentars.users'])->findOrFail($id);

        // Validation
        $request->validate([
            'isi_komentar' => 'required|string|max:1000',
        ]);

        // Store Komentar using relation to automatically fill the id_laporan
        $laporan->komentars()->create([
            'isi_komentar' => $request->isi_komentar,
            'fk_id_user' => Auth::id(), 
        ]);

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->route('laporan.detail', $laporan->id_laporan)->with('status', 'Komentar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Komentar $komentar)
    {
        // Validate that the user who delete the komentar is the owner of the komentar
        if ($komentar->fk_id_user !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus komentar ini.');
        }

        $komentar->delete();

        // TODO: define the redirect route according to frontend inside views/
        return redirect()->back()->with('status', 'Komentar berhasil dihapus!');
    }
}
