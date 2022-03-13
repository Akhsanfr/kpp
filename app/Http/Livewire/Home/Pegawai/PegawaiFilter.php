<?php

namespace App\Http\Livewire\Home\Pegawai;

use App\Models\Mingguan;
use Illuminate\Database\Eloquent\Builder;
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
    public $daftar_seksi = [
        'Pengawasan I',
        'Pengawasan II',
        'Pengawasan III',
        'Pengawasan IV',
        'Pengawasan V',
        'Pengawasan VI',
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

    public $pekans = [true, true, true, true, true], $seksis = [true,true,true,true,true,true], $bulan, $tahun;

    protected $queryString = [
        'bulan' => ['as' => 'b'],
        'tahun' => ['as' => 't'],
        'pekans' => ['as' => 'p'],
        'seksis' => ['as' => 's']
    ];

    public function updatedPekans(){
        $this->getData();
    }

    public function updatedSeksis(){
        $this->getData();
    }

    public function updatedBulan(){
        $this->getData();
    }
    public function updatedTahun(){
        $this->bulan =  "01";
        $this->getData();
    }

    public function mount(){
        $this->bulan = $_GET['b'] ?? date('m');
        $this->tahun = $_GET['t'] ?? date('Y');
        if($_GET['p'] ?? false){
            for($i = 0; $i <=4 ; $i++){
                $this->pekans[$i] = $_GET['p'][$i] == '1' ? true : false;
            }
        }
        if($_GET['s'] ?? false){
            for($i = 0; $i <=4 ; $i++){
                $this->seksis[$i] = $_GET['s'][$i] == '1' ? true : false;
            }
        }
    }

    public function getData(){
        $mingguans = Mingguan
            ::with('pegawai')
            ->where('bulan', $this->bulan)
            ->where('tahun', $this->tahun);
        $pekans = [];
        foreach($this->pekans as $index => $pekan){
            if($pekan){
                $pekans[] = $index + 1;
            }
        }
        $seksis = [];
        foreach($this->seksis as $index => $seksi){
            if($seksi){
                $seksis[] = $this->daftar_seksi[$index];
            }
        }
        $mingguans = $mingguans
            ->whereIn('pekan', $pekans)
            ->whereHas('pegawai', function(Builder $query) use ($seksis){
                $query->whereIn('seksi', $seksis);
            })
            ->get();
        // Grup data sesuai nama pegawai
        $mingguans = $mingguans->groupBy('pegawai.nama')->all();
        // Siapkan data untuk masing2 kolom (chart)
        foreach($this->columns as $column){
            // data kolom ...
            $data[$column] = [];
            foreach($mingguans as $pegawai => $mingguan){
                $data[$column][$pegawai] = $mingguan->sum($column);
            }
        }
        $this->dispatchBrowserEvent('chart-pegawai', $data);
    }

    public function render()
    {
        return view('livewire.home.pegawai.pegawai-filter');
    }
}
