<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorPertumbuhanBruto extends Component
{

    public $bruto;

    protected $listeners = ['chartPertumbuhanBruto'];

    public function chartPertumbuhanBruto($data)
    {
        $this->bruto = $data;
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-pertumbuhan-bruto');
    }
}
