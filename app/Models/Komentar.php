<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';

    protected $fillable = [
        'isi_komentar',
        'created_at',

        'fk_id_laporan',
        'fk_id_user',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'fk_id_user');
    }

    public function laporans()
    {
        return $this->belongsTo(Laporan::class, 'fk_id_laporan');
    }
}
