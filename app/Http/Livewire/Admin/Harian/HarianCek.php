<?php

namespace App\Http\Livewire\Admin\Harian;

use App\Models\Harian;
use Livewire\Component;

class HarianCek extends Component
{
    public $kalenders, $tanggals, $tahun , $tahuns;
    protected $queryString = [
        'tahun' => ['as' => 'ct','except' => ''],
    ];

    protected $listeners = [
        'refreshHarianCek' => '$refresh'
    ];

    public function mount(){
        $this->tahun = date('Y');
        $this->queryString['tahun']['except'] = date('Y');
    }

    

    public function render()
    {
        $daftar_bulan = [
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
        $kalenders = [];
        for ($i=1; $i <= 12; $i++) {

            $tahun_bulan_sekarang = $this->tahun;
            $tahun_bulan_berikutnya = $this->tahun;
            $bulan_sekarang = $i;
            $bulan_berikutnya = $i + 1;
            if($i === 12){
                // jika bulan desember
                $tahun_bulan_berikutnya = $tahun_bulan_berikutnya + 1; // tahun berikutnya
                $bulan_berikutnya = 1; // bulan januari tahun berikutnya
            }

            $tanggal_bulan_sekarang = "$tahun_bulan_sekarang-$bulan_sekarang-01";
            $tanggal_bulan_berikutnya = "$tahun_bulan_berikutnya-$bulan_berikutnya-01";

            // $bulan_end = $i + 1;
            // $tahun_end = $this->tahun;
            $period = new \DatePeriod(
                new \DateTime($tanggal_bulan_sekarang),
                new \DateInterval('P1D'),
                new \DateTime($tanggal_bulan_berikutnya)
            );
            // Get hari pertama dalam suatu bulan
            $hari_pertama = date('w', date_timestamp_get(date_create($tanggal_bulan_sekarang)));
            // Get hari pertama bulan berikutnya
            $hari_pertama_bulan_selanjutnya = date('w', date_timestamp_get(date_create($tanggal_bulan_berikutnya)));


            foreach ($period as $value) {
                $kalenders[$i]['tanggal'][] = $value->format('Y-m-d');
            }
            $kalenders[$i]['hari_pertama'] = $hari_pertama;
            $kalenders[$i]['hari_pertama_bulan_berikutnya'] = $hari_pertama_bulan_selanjutnya;
            $kalenders[$i]['nama_bulan'] = $daftar_bulan[$i - 1];
        }

        $this->kalenders = $kalenders;
        $this->tanggals = Harian::pluck('tanggal')->toArray();

        return view('livewire.admin.harian.harian-cek');
    }
}
