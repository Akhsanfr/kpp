<?php

namespace App\Http\Livewire\Pages;

use App\Models\Pegawai;
use App\Models\PenerimaanPegawai as ModelsPenerimaanPegawai;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PenerimaanPegawai extends Component
{
    public $sidebar = 'penerimaan-pegawai';

    protected $listeners = ['penerimaan-pegawai' => 'getPenerimaanPegawai'];

    protected $columns = [
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
        'stp_terbit_rupiah'
    ];

    public function getPenerimaanPegawai($tahun, $bulan, $pekan, $seksi){

        $penerimaans = ModelsPenerimaanPegawai
            ::join('pegawais', 'pegawais.id', '=', 'penerimaan_pegawais.pegawai_id' )
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->where('pekan', $pekan)
            ->whereRaw($seksi)
            ->get();
        $data = [];
        foreach($this->columns as $column){
            // data kolom ...
            $data[$column] = [];
            foreach($penerimaans as $penerimaan){
                // data kolom untuk pegawai ...
                $data[$column][$penerimaan->nama] = $penerimaan[$column];
            }
        }
        $this->dispatchBrowserEvent('chart-update', $data);
    }

    public function render()
    {
        return view('livewire.pages.penerimaan-pegawai')
                ->extends('layouts.home', ['sidebar' => 'penerimaan-pegawai'])
                ->section('main');
    }
}
