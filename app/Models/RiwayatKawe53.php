<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKawe53 extends Model
{
    protected $table = '53_riwayat_kawe';
    protected $guarded = [];
    public $timestamps = true;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa53::class, 'nim_id', 'nim');
    }

    public function kawe()
    {
        return $this->belongsTo(Kawe::class, 'kawe_id', 'kode_kawe');
    }
}
