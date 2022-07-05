<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPelanggaran extends Model
{
    use HasFactory;

    protected $table = 'laporan_pelanggaran';
    public $timestamps = false;

    protected $guarded = [];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class, 'id_laporan', 'id');
    }

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class, 'id_jenis_pelanggaran', 'id');
    }

    public function sangsi()
    {
        return $this->belongsTo(Sangsi::class, 'id_sangsi', 'id');
    }
}
