<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kawe extends Model
{
    protected $table = 'kawe';
    protected $primaryKey = 'kode_kawe';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = true;
}
