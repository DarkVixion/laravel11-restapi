<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class TindakLanjut extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'tanggal', 
        'tipe_observasi_id', 
        'status', 
        'deskripsi', 
        'img', 
        'laporan_id',
        'tanggal_akhir',
        'lokasi_id', 
        'detail_lokasi',
        'kategori_id',
        'clsr_id',
        'direct_action',
        'non_clsr', 
        'follow_up'];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'laporan_id');
    }

    public function scopeWithOverdueCheck($query)
    {
        return $query->select('*', DB::raw(
            "CASE
                WHEN status = 'OnProcess' AND tanggal_akhir IS NOT NULL AND tanggal_akhir < CURDATE()
                THEN 'Overdue'
                ELSE status
            END as status"
        ));
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

}