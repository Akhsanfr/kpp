<?php

namespace App\Http\Livewire\Admin\Lifetime;

use App\Models\Lifetime;
use Livewire\Component;

class LifetimeIndex extends Component
{
    public $lifetime;

    public $edit_mode;

    protected $rules = [
        'lifetime.peringkat_kpp_kanwil' => 'required',
        'lifetime.peringkat_kpp_non_pratama' => 'required',
        'lifetime.peringkat_kpp_nasional' => 'required',
        'lifetime.sektor_pajak_bruto_terbesar_1' => 'required',
        'lifetime.sektor_pajak_bruto_terbesar_2' => 'required',
        'lifetime.sektor_pajak_bruto_terbesar_3' => 'required',
        'lifetime.sektor_wp_tertinggi_1' => 'required',
        'lifetime.sektor_wp_tertinggi_2' => 'required',
        'lifetime.sektor_wp_tertinggi_3' => 'required',
        'lifetime.sektor_wp_tertinggi_4' => 'required',
        'lifetime.sektor_wp_tertinggi_5' => 'required',
    ];

    public function switchEdit($val){
        $this->edit_mode = $val;
    }

    public function update(){
        $this->validate();
        $this->lifetime->save();
        $this->edit_mode = false;
        $this->getData();
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menyimpan data']]);
    }

    public function getData(){
        $this->lifetime = Lifetime::first();
    }

    public function mount(){
        $this->getData();
    }

    public function render()
    {
        return view('livewire.admin.lifetime.lifetime-index')->extends('layouts.admin');
    }
}
