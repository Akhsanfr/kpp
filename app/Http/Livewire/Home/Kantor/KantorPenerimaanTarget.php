<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorPenerimaanTarget extends Component
{

    public $target;

    protected $listeners = ['chartPenerimaanTarget'];

    public function chartPenerimaanTarget($data){
        $this->target = $data;
    }

    // public function refreshTahunan($tahun){
    //     $this->getData($tahun);
    // }

    // protected function getData($tahun){
    //     $this->tes = $tahun;

        // $tahunan = Tahunan::where('tahun', $tahun)->first();
        // if(is_null($tahunan)){
        //     $this->target = "Data tidak tersedia";
        // } else {
        //     $this->target = number_format($tahunan->target, env('DECIMAL'),',','.');
        // }



        // $date_awal = "$tahun-01-01";
        // $date_akhir = "$tahun-12-31";
        // $netto = Harian::whereBetween('tanggal', [$date_awal, $date_akhir])->sum('netto');
        // $bruto = Harian::whereBetween('tanggal', [$date_awal, $date_akhir])->sum('bruto');
        // $spmkp = $bruto - $netto;
        // $this->netto = number_format($netto, env('DECIMAL'), ',', '.');
        // $this->spmkp = number_format($spmkp, env('DECIMAL'), ',', '.');
    // }

    // public function mount(){
    //     $this->getData($_GET['t'] ?? date('Y'));
    // }

    public function render()
    {
        return view('livewire.home.kantor.kantor-penerimaan-target');
    }
}
