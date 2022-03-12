<?php

namespace App\Http\Livewire\Home\Kantor;

use App\Models\Harian;
use Livewire\Component;

class KantorPerbulan extends Component
{

    // public $tes;

    // protected $listeners = ['refreshTahunan'=> 'getData'];

    // public function getData($tahun){
    //     $bruto = [];
    //     $netto = [];
    //     $spmkp = [];
    //     $bulan = [
    //         "Januari",
    //         "Februari",
    //         "Maret",
    //         "April",
    //         "Mei",
    //         "Juni",
    //         "Juli",
    //         "Agustus",
    //         "September",
    //         "Oktober",
    //         "November",
    //         "Desember"
    //     ];
    //     for ($i = 1; $i <= 12; $i++) {
    //         $bruto[$bulan[$i - 1]] = Harian
    //             ::whereRaw('MONTH(tanggal) = ' . $i . ' AND YEAR(tanggal) = ' . $tahun)
    //             ->sum('bruto');
    //         $netto[$bulan[$i - 1]] = Harian
    //             ::whereRaw('MONTH(tanggal) = ' . $i . ' AND YEAR(tanggal) = ' . $tahun)
    //             ->sum('netto');
    //         $spmkp[$bulan[$i - 1]] = $bruto[$bulan[$i - 1]] - $netto[$bulan[$i - 1]];
    //     }
    //     $this->dispatchBrowserEvent('chart-perbulan',
    //         compact('bruto', 'netto', 'spmkp')
    //     );
    //     $this->tes = "$tahun";
    // }

    public function render()
    {
        return view('livewire.home.kantor.kantor-perbulan');
    }
}
