<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'Barang';

    protected $fillable = [
        'kategori_barang',
        'nama_barang',
        'lokasi',
        'foto_barang',
        
        'id_laporan',
    ];
}
