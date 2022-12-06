<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UjianAkhir extends Model
{
    use HasFactory;

    protected $table = 'ujianakhir';
    protected $guarded = [];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
