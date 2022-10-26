<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganSkripsi extends Model
{
    use HasFactory;


    protected $table = 'bimbinganskripsi';
    protected $guarded = [];


    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
