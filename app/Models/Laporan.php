<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'img', 
        'user_id', 
        'lokasi_id', 
        'tipe_observasi_id', 
        'kategori_id', 
        'clsr_id',
        'nama_pegawai',
        'email_pegawai',
        'nama_fungsi' ,
        'lokasi_spesifik',
        'deskripsi_observasi' ,
        'direct_action' ,
        'saran_aplikasi' ,
        ];

    public function pengguna()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function tipeObservasi()
    {
        return $this->belongsTo(TipeObservasi::class, 'tipe_observasi_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function clsr()
    {
        return $this->belongsTo(CLSR::class, 'clsr_id');
    }

    public function tindakLanjuts()
    {
        return $this->hasMany(TindakLanjut::class, 'laporan_id');
    }
}