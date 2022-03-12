<?php

namespace App\Http\Livewire\Pages;

use App\Models\DataSekarang;
use App\Models\Penerimaan as ModelsPenerimaan;
use Livewire\Component;

class Penerimaan extends Component
{
    public $targetKKP,
    $penerimaanNetto,
    $SPMKP,
    $netto,
    $bruto,
    $capaian_netto,
    $capaian_bruto,
        $dataSekarang
    ;

    protected $listeners = [
        'penerimaan-harian' => 'getPenerimaanPerTanggal',
        'penerimaan-tahunan' => 'getPenerimaanPerTahun',
    ];

    public function getPenerimaanPerTanggal($day_start, $day_end, $month, $year, $tipe)
    {
        $tanggal_start = $year . '-' . $month . '-' . $day_start;
        $tanggal_end = $year . '-' . $month . '-' . $day_end;
        $penerimaans = ModelsPenerimaan::whereBetween('tanggal', [$tanggal_start, $tanggal_end])
            ->where('tipe', $tipe)->get();
        $this->targetKKP = 'Rp.' . number_format($penerimaans->sum('penerimaan_target'), 0, ",", ".");
        $this->penerimaanNetto = 'Rp.' . number_format($penerimaans->sum('penerimaan_netto'), 0, ",", ".");
        $this->SPMKP = 'Rp.' . number_format($penerimaans->sum('penerimaan_spmkp'), 0, ",", ".");
        // Fire Chart
        $this->dispatchBrowserEvent('chart-update',
            [
                'PPN-Impor' => $penerimaans->sum('ppn_impor'),
                'PPNDN' => $penerimaans->sum('pph_ppndn'),
                'PPH-25/9' => $penerimaans->sum('pph_25_9'),
                'PPH-23' => $penerimaans->sum('pph_23'),
                'PPH-22-Impor' => $penerimaans->sum('pph_22_impor'),
                'PPH-22' => $penerimaans->sum('pph_22'),
                'PPH-21' => $penerimaans->sum('pph_21'),
            ]
        );
        $this->emit('chartPertumbuhanNettoBruto', [
            'netto' => $penerimaans->sum('pertumbuhan_netto'),
            'bruto' => $penerimaans->sum('pertumbuhan_bruto'),
        ]);
        $this->emit('chartCapaianNettoBruto', [
            'netto' => $penerimaans->sum('capaian_netto'),
            'bruto' => $penerimaans->sum('capaian_bruto'),
        ]);
    }

    public function getPenerimaanPerTahun($tahun, $tipe)
    {
        $data_bruto = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_bruto[$i] = ModelsPenerimaan
                ::selectRaw('SUM(ppn_impor + pph_ppndn + pph_25_9 + pph_23 + pph_22_impor + pph_22 + pph_21) as jumlah')
                ->whereRaw('MONTH(tanggal) = ' . $i . ' AND YEAR(tanggal) = ' . $tahun)
                ->where('tipe', 'spmkp')
                ->first()->jumlah;
        }
        $data_spmkp = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_spmkp[$i] = ModelsPenerimaan
                ::selectRaw('SUM(ppn_impor + pph_ppndn + pph_25_9 + pph_23 + pph_22_impor + pph_22 + pph_21) as jumlah')
                ->whereRaw('MONTH(tanggal) = ' . $i . ' AND YEAR(tanggal) = ' . $tahun)
                ->where('tipe', 'bruto')
                ->first()->jumlah;
        }
        // $this->dataBulanan = $data;
        $data_netto = [];
        for ($i = 1; $i <= 12; $i++) {
            $data_netto[$i] = $data_bruto[$i] - $data_spmkp[$i];
        }
        // dd($data_spmkp);
        $this->dispatchBrowserEvent('chart-bulanan', compact('data_spmkp', 'data_bruto', 'data_netto'));
    }

    public function tes()
    {
        return 'ini pesan';
    }

    public function mount()
    {
        $this->dataSekarang = DataSekarang::first();
    }

    public function render()
    {
        return view('livewire.pages.penerimaan')
            ->extends('layouts.home', ['sidebar' => 'penerimaan'])
            ->section('main');
    }
}
