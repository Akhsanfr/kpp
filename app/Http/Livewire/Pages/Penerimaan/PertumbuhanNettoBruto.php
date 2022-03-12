<?php

namespace App\Http\Livewire\Pages\Penerimaan;

use Livewire\Component;

class PertumbuhanNettoBruto extends Component
{

    public $netto;
    public $bruto;

    protected $listeners = ['chartPertumbuhanNettoBruto'];

    public function chartPertumbuhanNettoBruto($data)
    {
        $this->netto = $data['netto'];
        $this->bruto = $data['bruto'];
    }

    public function render()
    {
        return view('livewire.pages.penerimaan.pertumbuhan-netto-bruto');
    }
}
