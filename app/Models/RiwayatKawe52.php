<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKawe52 extends Model
{
    protected $table = '52_riwayat_kawe';
    protected $guarded = [];
    public $timestamps = true;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa52::class, 'nim_id', 'nim');
    }

    public function kawe()
    {
        return $this->belongsTo(Kawe::class, 'kawe_id', 'kode_kawe');
    }
}
