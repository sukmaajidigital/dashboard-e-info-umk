<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKeterampilanKawe extends Model
{
    protected $table = 'program_keterampilan_kawe';
    protected $guarded = [];
    public $timestamps = true;

    public function kawe()
    {
        return $this->belongsTo(Kawe::class, 'kawe_id', 'kode_kawe');
    }
}
