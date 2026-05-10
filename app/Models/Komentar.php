<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $table = 'Komentar';

    protected $fillable = [
        'isi_komentar',
        'created_at',

        'id_laporan',
        'id_user',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function laporans()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan');
    }
}
