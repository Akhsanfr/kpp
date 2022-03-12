<?php

namespace App\Http\Livewire\Admin\Tahunan;

use App\Models\Tahunan;
use Livewire\Component;

class TahunanIndex extends Component
{

    public $tahunans = [];
    public $component = 'tabel';
    public $tahunan_id;

    protected $queryString = [
        'component' => ['as' => 'c', 'except' => 'tabel']
    ];

    public function switchComponent($component, $tahunan_id = ''){
        $this->component = $component;
        $this->tahunan_id = $tahunan_id;
    }

    protected $listeners = [
        'afterSavingForm',
        'switchComponent'
    ];

    public function afterSavingForm(){
        $this->switchComponent('tabel');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menyimpan data']]);
    }

    public function mount(){
         $this->tahunans = Tahunan::all();
    }
    public function render()
    {
        return view('livewire.admin.tahunan.tahunan-index')->extends('layouts.admin');
    }
}
