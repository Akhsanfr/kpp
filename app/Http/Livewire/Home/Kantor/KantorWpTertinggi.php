<?php

namespace App\Http\Livewire\Home\Kantor;

use App\Models\Lifetime;
use Livewire\Component;

class KantorWpTertinggi extends Component
{

    public $lifetime;

    public function mount(){
        $this->lifetime = Lifetime::first();
    }

    public function render()
    {
        return view('livewire.home.kantor.kantor-wp-tertinggi');
    }
}
