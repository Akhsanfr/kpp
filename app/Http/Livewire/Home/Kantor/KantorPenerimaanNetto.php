<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorPenerimaanNetto extends Component
{

    public $netto;

    protected $listeners = ['chartPenerimaanNetto'];

    public function chartPenerimaanNetto($data){
        $this->netto = $data;
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-penerimaan-netto');
    }
}
