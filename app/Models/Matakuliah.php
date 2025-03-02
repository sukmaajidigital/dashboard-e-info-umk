<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'kode_matakuliah';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = true;

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'kode_prodi');
    }
}
