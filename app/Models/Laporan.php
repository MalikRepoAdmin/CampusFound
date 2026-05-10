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


    public function users()
    {
        return $this->belongsTo(User::class, 'is_user');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'id_laporan');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'id_laporan');
    }
}
