<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaim extends Model
{
    use HasFactory;

    protected $table = 'klaim';
    protected $primaryKey = 'id_klaim';

    protected $fillable = [
        'ciri',
        'foto_bukti',

        'fk_id_user',
        'fk_id_laporan',
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
