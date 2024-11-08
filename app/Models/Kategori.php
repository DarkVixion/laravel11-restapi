<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'level', 'kategori_id'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function tindaklanjutss()
    {
        return $this->hasMany(TindakLanjut::class);
    }

    public function parent()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function children()
    {
        return $this->hasMany(Kategori::class, 'kategori_id');
    }
}