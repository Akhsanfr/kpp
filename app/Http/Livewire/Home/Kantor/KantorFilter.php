<?php

namespace App\Http\Livewire\Home\Kantor;

use App\Models\Harian;
use App\Models\Lifetime;
use App\Models\Tahunan;
use Livewire\Component;

class KantorFilter extends Component
{
    // ### PUBLIC
        public $kalender;
    // END PUBLIC

    // ### FILTER //
        public $tanggal_awal, $tanggal_akhir, $bulan, $tahun, $tanggals;
        protected $queryString = [
            'tanggal_awal' => ['as' => 's'],
            'tanggal_akhir' => ['as' => 'e'],
            'bulan' => ['as' => 'b'],
            'tahun' => ['as' => 't']
        ];

        public function pilihTanggal($tanggal){
            $this->setTanggal($tanggal);
            $this->getDataHarian();
        }

        public function updatedBulan(){
            $this->setTanggal(1);
            $this->setTanggal(1);
            $this->getDataHarian();
            $this->getAvailableDate();
        }

        public function updatedTahun($tahun){
            $this->bulan = "01";
            $this->setTanggal(1);
            $this->setTanggal(1);
            $this->getDataHarian();
            $this->getDataTahunan();
            $this->getAvailableDate();
        }
        public function resetTanggal(){
            $this->tanggal_awal = date('d');
            $this->tanggal_akhir = date('d');
            $this->bulan = date('m');
            // jika tahun aktif, tidak perlu get data tahunan
            // tahun skrg , tahun aktif
            if(date('Y') !== $this->tahun){
                // set tahun aktif ke tahun sekarang
                $this->tahun = date('Y');
                // get data tahunan
                $this->getDataTahunan();
            }
            // set tahun aktif ke tahun sekarang
            $this->tahun = date('Y');
            $this->getDataHarian();
        }

        public function setTanggal($tanggal){
            array_shift($this->tanggals);
            array_push($this->tanggals, $tanggal);
            if($this->tanggals[0] < $this->tanggals[1]){
                $this->tanggal_awal = $this->tanggals[0];
                $this->tanggal_akhir = $this->tanggals[1];
            } else {
                $this->tanggal_awal = $this->tanggals[1];
                $this->tanggal_akhir = $this->tanggals[0];
            }
        }
    // END FILTER

    // ### GET DATA

        public function getDataTahunan(){
            $tahunan = Tahunan::where('tahun', $this->tahun)->first();
            $harians = Harian::whereRaw('YEAR(tanggal) = ' . $this->tahun)->get();


            if(is_null($tahunan)){
                $tahunan = 0;
                $capaian_netto = false;
                $capaian_bruto = false;
            } else {
                $tahunan = $tahunan->target;
                // dump($harians);
                // dump($tahunan);
                $capaian_netto =bcdiv($harians->sum('netto'), $tahunan, 100);
                // dump($harians->sum('netto'));
                $capaian_bruto =bcdiv($harians->sum('bruto'), $tahunan, 100);
            }

            $this->emit('chartPenerimaanTarget', $tahunan);
            $this->emit('chartPenerimaanNetto', $harians->sum('netto'));
            $this->emit('chartPenerimaanSpmkp', $harians->sum('bruto') - $harians->sum('netto'));

            $this->emit('chartCapaianNetto', $capaian_netto);
            $this->emit('chartCapaianBruto', $capaian_bruto);

            $bruto = [];
            $netto = [];
            $spmkp = [];
            for ($i = 1; $i <= 12; $i++) {
                $harians_by_month =  Harian
                    ::whereRaw('MONTH(tanggal) = ' . $i . ' AND YEAR(tanggal) = ' . $this->tahun)
                    ->get();
                $bruto[$this->kalender['bulan'][$i -1]] = $harians_by_month->sum('bruto');
                $netto[$this->kalender['bulan'][$i -1]] = $harians_by_month->sum('netto');
                $spmkp[$this->kalender['bulan'][$i -1]] = $bruto[$this->kalender['bulan'][$i -1]] - $netto[$this->kalender['bulan'][$i -1]];
            }
            $this->dispatchBrowserEvent('chart-perbulan',
                compact('bruto', 'netto', 'spmkp')
            );

        }

        public function getDataHarian(){
            // ### GET DATA UTAMA //
                $tanggal_awal = $this->tahun."-".$this->bulan."-".$this->tanggal_awal;
                $tanggal_akhir = $this->tahun."-".$this->bulan."-".$this->tanggal_akhir;
                $harians = Harian
                ::whereBetween('tanggal',[$tanggal_awal, $tanggal_akhir])
                ->get();
                // dump($haria)
            // END GET DATA UTAMA //

            // ### GET DATA TAHUN SEBELUMNYA //
                $tanggal_awal_tahun_sebelumnya = ($this->tahun - 1)."-".$this->bulan."-".$this->tanggal_awal;
                $tanggal_akhir_tahun_sebelumnya = ($this->tahun - 1)."-".$this->bulan."-".$this->tanggal_akhir;
                $harians_tahun_sebelumnya = Harian
                    ::whereBetween('tanggal',[$tanggal_awal_tahun_sebelumnya, $tanggal_akhir_tahun_sebelumnya])
                    ->get();
            // END GET DATA TAHUN SEBELUMNYA //

            // ### PERTUMBUHAN //
                $netto = $harians->sum('netto');
                $netto_tahun_sebelumnya = $harians_tahun_sebelumnya->sum('netto');
                if($netto_tahun_sebelumnya === 0){
                    $pertumbuhan_netto = false;
                } else {
                    $pertumbuhan_netto = bcdiv($netto, $netto_tahun_sebelumnya, 100);
                }
                $bruto = $harians->sum('bruto');
                $bruto_tahun_sebelumnya = $harians_tahun_sebelumnya->sum('bruto');
                if($bruto_tahun_sebelumnya === 0){
                    $pertumbuhan_bruto = false;
                } else {
                    $pertumbuhan_bruto = bcdiv($bruto, $bruto_tahun_sebelumnya, 100);
                }
                $this->emit('chartPertumbuhanNetto', $pertumbuhan_netto);
                $this->emit('chartPertumbuhanBruto', $pertumbuhan_bruto);
            // END PERTUMBUHAN //

            // ### PERJENIS //
                $this->dispatchBrowserEvent('chartPerjenis',
                    [
                        'PPN-Impor' => $harians->sum('ppn_impor'),
                        'PPNDN' => $harians->sum('pph_ppndn'),
                        'PPH-25/9' => $harians->sum('pph_25_9'),
                        'PPH-23' => $harians->sum('pph_23'),
                        'PPH-22-Impor' => $harians->sum('pph_22_impor'),
                        'PPH-22' => $harians->sum('pph_22'),
                        'PPH-21' => $harians->sum('pph_21'),
                    ]
                );
            // END PERJENIS //

        }
    // END GET DATA

    protected function getAvailableDate(){

            $this->kalender['tanggal'] = [];
            $tahun_bulan_sekarang = $this->tahun;
            $tahun_bulan_berikutnya = $this->tahun;
            $bulan_sekarang = $this->bulan;
            $bulan_berikutnya = $this->bulan + 1;
            if($this->bulan == 12){
                // jika bulan desember
                $tahun_bulan_berikutnya = $tahun_bulan_berikutnya + 1; // tahun berikutnya
                $bulan_berikutnya = 1; // bulan januari tahun berikutnya
            }

            $tanggal_bulan_sekarang = "$tahun_bulan_sekarang-$bulan_sekarang-01";
            $tanggal_bulan_berikutnya = "$tahun_bulan_berikutnya-$bulan_berikutnya-01";

            // // $bulan_end = $i + 1;
            // // $tahun_end = $this->tahun;
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
                $this->kalender['tanggal'][] = $value->format('d');
            }
            $this->kalender['hari_pertama'] = $hari_pertama;
            $this->kalender['hari_pertama_bulan_berikutnya'] = $hari_pertama_bulan_selanjutnya;
    }

    public function mount(){
        $this->tanggal_awal = $_GET['s'] ?? date('d');
        $this->tanggal_akhir = $_GET['e'] ?? date('d');
        $this->tanggals = [ $_GET['s'] ?? date('d'),  $_GET['e'] ?? date('d')];
        $this->bulan = $_GET['b'] ?? date('m');
        $this->tahun = $_GET['t'] ?? date('Y');
        $this->kalender['bulan'] = [
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
        $this->getAvailableDate();
    }

    public function init(){
        $this->getDataTahunan();
        $this->getDataHarian();
    }

    public function render()
    {
        // dump($this->bulan);
        $this->queryString['tanggal_awal']['except'] = date('d');
        $this->queryString['tanggal_akhir']['except'] = date('d');
        $this->queryString['bulan']['except'] = date('m');
        $this->queryString['tahun']['except'] = date('Y');
        return view('livewire.home.kantor.kantor-filter');
    }
}
