<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorCapaianNetto extends Component
{
    public $netto;

    protected $listeners = ['chartCapaianNetto'];

    public function chartCapaianNetto($data)
    {
        $this->netto = $data;
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-capaian-netto');
    }
}
