<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatMatakuliah53 extends Model
{
    protected $table = '53_riwayat_matakuliah';
    protected $guarded = [];
    public $timestamps = true;

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa53::class, 'nim_id', 'nim');
    }

    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'matakuliah_id', 'kode_matakuliah');
    }
}
