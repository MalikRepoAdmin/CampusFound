<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // No need index function because barang is managed in LaporanController
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // No need create function because barang is managed in LaporanController
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // No need store function because barang is managed in LaporanController
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        // No need show function because barang is managed in LaporanController
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        //
    }
}
