<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.home')
            ->extends('layouts.main')
            ->section('app');
    }
}
