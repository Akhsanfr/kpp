<?php

namespace App\Http\Livewire\Home\Kantor;

use App\Models\Harian;
use Livewire\Component;

class KantorIndex extends Component
{

    // public $tanggal_awal, $tanggal_akhir, $bulan, $tahun;
    // public $kalender;

    // public $date_active;

    // public $harians;
    // public $tahunan;
    // public $lifetime;

    // protected $queryString = [
    //     'tanggal_awal' => ['as' => 's'],
    //     'tanggal_akhir' => ['as' => 'e'],
    // ];

    // public function getDataHarians(){
    //     $this->harians = Harian
    //         ::whereBetween('tanggal', [
    //                 $this->tahun."-".$this->bulan."-".$this->tanggal_awal,
    //                 $this->tahun."-".$this->bulan."-".$this->tanggal_akhir
    //             ])
    //         ->get();
    //     $this->date_active = $this->harians->pluck('tanggal');
    // }

    // protected function getAvailableDate(){

    //         $tahun_bulan_sekarang = $this->tahun;
    //         $tahun_bulan_berikutnya = $this->tahun;
    //         $bulan_sekarang = $this->bulan;
    //         $bulan_berikutnya = $this->bulan + 1;
    //         if($this->bulan === 12){
    //             // jika bulan desember
    //             $tahun_bulan_berikutnya = $tahun_bulan_berikutnya + 1; // tahun berikutnya
    //             $bulan_berikutnya = 1; // bulan januari tahun berikutnya
    //         }

    //         $tanggal_bulan_sekarang = "$tahun_bulan_sekarang-$bulan_sekarang-01";
    //         $tanggal_bulan_berikutnya = "$tahun_bulan_berikutnya-$bulan_berikutnya-01";

    //         // // $bulan_end = $i + 1;
    //         // // $tahun_end = $this->tahun;
    //         $period = new \DatePeriod(
    //             new \DateTime($tanggal_bulan_sekarang),
    //             new \DateInterval('P1D'),
    //             new \DateTime($tanggal_bulan_berikutnya)
    //         );
    //         // Get hari pertama dalam suatu bulan
    //         $hari_pertama = date('w', date_timestamp_get(date_create($tanggal_bulan_sekarang)));
    //         // Get hari pertama bulan berikutnya
    //         $hari_pertama_bulan_selanjutnya = date('w', date_timestamp_get(date_create($tanggal_bulan_berikutnya)));


    //         foreach ($period as $value) {
    //             $this->kalender['tanggal'][] = $value->format('d');
    //         }
    //         $this->kalender['hari_pertama'] = $hari_pertama;
    //         $this->kalender['hari_pertama_bulan_berikutnya'] = $hari_pertama_bulan_selanjutnya;
    // }

    // public function mount(){
    //     $this->tanggal_awal = date('d');
    //     $this->tanggal_akhir = date('d');
    //     $this->bulan = "03";
    //     // $this->bulan = date('m');
    //     $this->tahun = date('Y');
    //     $this->kalender['bulan'] = [
    //         ["01","Januari"],
    //         ["02","Februari"],
    //         ["03","Maret"],
    //         ["04","April"],
    //         ["05","Mei"],
    //         ["06","Juni"],
    //         ["07","Juli"],
    //         ["08","Agustus"],
    //         ["09","September"],
    //         ["10","Oktober"],
    //         ["11","November"],
    //         ["12","Desember"]
    //     ];
    //     $this->getDataHarians();
    //     $this->getAvailableDate();
    // }



    public function render()
    {

        return view('livewire.home.kantor.kantor-index')->extends('layouts.home');
    }
}
