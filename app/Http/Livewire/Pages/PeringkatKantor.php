<?php

namespace App\Http\Livewire\Pages;

use App\Models\DataSekarang;
use Livewire\Component;

class PeringkatKantor extends Component
{
    public $data;
    public function mount(){
        $this->data = DataSekarang::first();
    }

    public function render()
    {
        return view('livewire.pages.peringkat-kantor');
    }
}
