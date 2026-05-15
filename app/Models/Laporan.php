<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $fillable = [
        'kategori_laporan',
        'status_laporan',
        'deskripsi',

        'fk_id_user',
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'fk_id_user');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'fk_id_laporan');
    }

    public function komentars()
    {
        return $this->hasMany(Komentar::class, 'fk_id_laporan');
    }
}
