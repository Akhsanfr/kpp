<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaanPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'tahun',
        'bulan',
        'pekan',
        'sp2dk_target',
        'sp2dk_jumlah',
        'lhp2dk_target',
        'lhp2dk_jumlah',
        'lp2dk_realisasi_rupiah',
        'lhpt_target',
        'lhpt_jumlah',
        'sp2dk_terbit_target',
        'sp2dk_terbit_jumlah',
        'lhpt_lhp2dk_target',
        'lhpt_lhp2dk_jumlah',
        'lhp2dk_realisasi_rupiah',
        'stp_terbit_target',
        'stp_terbit_jumlah',
        'stp_terbit_rupiah',
        'pegawai_id'
    ];

    public function pegawai(){
        return $this->belongsTo(Pegawai::class);
    }
}
