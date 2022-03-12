<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorCapaianBruto extends Component
{
    public $bruto;

    protected $listeners = ['chartCapaianBruto'];

    public function chartCapaianBruto($data)
    {
        $this->bruto = $data;
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-capaian-bruto');
    }
}
