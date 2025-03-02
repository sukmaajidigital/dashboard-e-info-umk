<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'kode_prodi';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = true;

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'fakultas_id', 'kode_fakultas');
    }
}
