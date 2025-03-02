<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa52 extends Model
{
    protected $table = '52_mahasiswa';
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
