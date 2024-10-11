<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CLSR extends Model
{
    use HasFactory;
    
    protected $table = 'clsrs';
    protected $fillable = ['elemen', 'nama', 'deskripsi', 'contoh'];

    public function laporans()
    {
        return $this->hasMany(Laporan::class);
    }
}