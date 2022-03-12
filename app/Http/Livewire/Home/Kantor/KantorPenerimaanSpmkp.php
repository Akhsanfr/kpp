<?php

namespace App\Http\Livewire\Home\Kantor;

use Livewire\Component;

class KantorPenerimaanSpmkp extends Component
{
    public $spmkp;

    protected $listeners = ['chartPenerimaanSpmkp'];

    public function chartPenerimaanSpmkp($data){
        $this->spmkp = $data;
    }
    public function render()
    {
        return view('livewire.home.kantor.kantor-penerimaan-spmkp');
    }
}
