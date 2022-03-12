<?php

namespace App\Http\Livewire\Home\Pegawai;

use Livewire\Component;

class PegawaiIndex extends Component
{
    public function render()
    {
        return view('livewire.home.pegawai.pegawai-index')->extends('layouts.home');
    }
}
