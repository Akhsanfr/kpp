<?php

namespace App\Http\Livewire\Home\Pegawai;

use Livewire\Component;

class PegawaiFilter extends Component
{
    public $bulans = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember"
    ];

    public $bulan, $tahun;

    protected $queryString = [
        'bulan' => ['as' => 'b'],
        'tahun' => ['as' => 't'],
    ];

    public function mount(){
        $this->bulan = $_GET['b'] ?? date('m');
        $this->tahun = $_GET['t'] ?? date('Y');
    }

    public function render()
    {
        return view('livewire.home.pegawai.pegawai-filter');
    }
}
