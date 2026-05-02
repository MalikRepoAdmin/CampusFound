<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    
    protected $table = 'Laporan';

    protected $fillable = [
        'kategori_laporan',
        'status_laporan',
        'deskripsi',
        'id_user',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        // TODO: relation one-to-many into 'Barang' Model
        return $this->hasMany(Barang::class);
    }
}
