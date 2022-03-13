<?php

namespace App\Http\Livewire\Home\Pegawai;

use App\Models\Mingguan;
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

    public $pekans = [true, true, true, true, true], $bulan, $tahun;

    protected $queryString = [
        'bulan' => ['as' => 'b'],
        'tahun' => ['as' => 't'],
    ];

    public function mount(){
        $this->bulan = $_GET['b'] ?? date('m');
        $this->tahun = $_GET['t'] ?? date('Y');
    }

    public function getData(){
        $mingguans = Mingguan
            ::where('bulan', $this->bulan)
            ->where('tahun', $this->tahun);
        $pekans = [];
        foreach($this->pekans as $index => $pekan){
            if($pekan){
                $pekans[] = $index + 1;
            }
        }
        $mingguans = $mingguans->whereIn('pekan', $pekans)->get();
        foreach($this->columns as $column){
            // data kolom ...
            $data[$column] = [];
            foreach($mingguans as $mingguan){
                // data kolom untuk pegawai ...
                $data[$column][$mingguan->nama] = $mingguan[$column];
            }
        }
        $this->dispatchBrowserEvent('chart-pegawai', $data);
    }

    public function render()
    {
        return view('livewire.home.pegawai.pegawai-filter');
    }
}
