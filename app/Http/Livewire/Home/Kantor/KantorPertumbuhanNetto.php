<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorPertumbuhanNetto extends Component
{
    public $netto;

    protected $listeners = ['chartPertumbuhanNetto'];

    public function chartPertumbuhanNetto($data)
    {
        $this->netto = $data;
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-pertumbuhan-netto');
    }
}
