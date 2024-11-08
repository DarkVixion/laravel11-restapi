<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
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

    public function parent()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function children()
    {
        return $this->hasMany(Lokasi::class, 'lokasi_id');
    }
}