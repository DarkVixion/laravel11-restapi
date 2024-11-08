<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeObservasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }

    public function tindaklanjuts()
    {
        return $this->hasMany(TindakLanjut::class);
    }
}