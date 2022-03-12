<?php

namespace App\Http\Livewire\Pages\Penerimaan;

use Livewire\Component;

class CapaianNettoBruto extends Component
{
    public $netto;
    public $bruto;

    protected $listeners = ['chartCapaianNettoBruto'];

    public function chartCapaianNettoBruto($data)
    {
        $this->netto = $data['netto'];
        $this->bruto = $data['bruto'];
    }

    public function render()
    {
        return view('livewire.pages.penerimaan.capaian-netto-bruto');
    }
}
