<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPL extends Model
{
    use HasFactory;

    protected $table = 'spl';
    protected $guarded = [];

    public function tahunAjaran()
    {
        return $this->belongsTo(TahunAjaran::class);
    }
}
