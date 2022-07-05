<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanDokumentasi extends Model
{
    use HasFactory;

    protected $table = 'laporan_dokumentasi';
    public $timestamps = false;

    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id');
    }
}
