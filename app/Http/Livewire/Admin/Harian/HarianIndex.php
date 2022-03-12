<?php

namespace App\Http\Livewire\Admin\Harian;

use Livewire\Component;

class HarianIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.harian.harian-index')
            ->extends('layouts.admin')
        ;
    }
}
