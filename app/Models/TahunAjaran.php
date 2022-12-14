<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tahun_ajaran';
    protected $guarded = [];

    public function spl()
    {
        return $this->hasMany(SPL::class);
    }
    public function magang()
    {
        return $this->hasMany(Magang::class);
    }

    public function bimbinganSkripsi()
    {
        return $this->hasMany(BimbinganSkripsi::class);
    }
    public function sempro()
    {
        return $this->hasMany(Sempro::class);
    }
    public function kompre()
    {
        return $this->hasMany(Kompre::class);
    }

    
    public function mengulang()
    {
        return $this->hasMany(Mengulang::class);
    }

    public function ujianAkhir()
    {
        return $this->hasMany(UjianAkhir::class);
    }

    public function yudisium()
    {
        return $this->hasMany(Yudisium::class);
    }
}
