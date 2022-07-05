<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function jenisKegiatan()
    {
        return $this->belongsTo(JenisKegiatan::class, 'id_jenis_kegiatan', 'id');
    }

    public function laporanPelanggaran()
    {
        return $this->hasOne(LaporanPelanggaran::class, 'id_laporan', 'id');
    }

    public function laporanDokumentasi()
    {
        return $this->hasOne(LaporanDokumentasi::class, 'id_laporan', 'id');
    }
}
