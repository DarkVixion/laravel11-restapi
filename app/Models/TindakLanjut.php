<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class TindakLanjut extends Model
{
    use HasFactory;
    

    protected $fillable = ['tanggal', 'tipe', 'status', 'deskripsi', 'img', 'laporan_id','tanggal_akhir'];

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
}