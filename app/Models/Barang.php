<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'kategori_barang',
        'nama_barang',
        'lokasi',
        'foto_barang',
        
        'fk_id_laporan',
    ];

    public function laporans()
    {
        return $this->belongsTo(Laporan::class, 'fk_id_laporan');
    }
}
