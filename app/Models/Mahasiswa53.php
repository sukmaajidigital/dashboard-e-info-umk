<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa53 extends Model
{
    protected $table = '53_mahasiswa';
    protected $primaryKey = 'nim';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = true;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'kode_prodi');
    }
}
