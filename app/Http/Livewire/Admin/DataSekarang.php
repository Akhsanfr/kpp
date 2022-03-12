<?php

namespace App\Http\Livewire\Admin;

use App\Models\DataSekarang as ModelsDataSekarang;
use Livewire\Component;
use PhpParser\Node\Expr\FuncCall;

class DataSekarang extends Component
{
    public $datas;

    public function save($peringkat_kpp_kanwil,$peringkat_kpp_nonpratama,$peringkat_kpp_nasional,$peringkat_pajak_1,$peringkat_pajak_2,$peringkat_pajak_3){
        $this->datas->peringkat_kpp_kanwil = $peringkat_kpp_kanwil;
        $this->datas->peringkat_kpp_nonpratama = $peringkat_kpp_nonpratama;
        $this->datas->peringkat_kpp_nasional = $peringkat_kpp_nasional;
        $this->datas->peringkat_pajak_1 = $peringkat_pajak_1;
        $this->datas->peringkat_pajak_2 = $peringkat_pajak_2;
        $this->datas->peringkat_pajak_3 = $peringkat_pajak_3;
        if($this->datas->save()){
            $this->dispatchBrowserEvent('pesan', ['isi' => ['Data berhasil disimpan'], 'tipe' => 'success']);
        } else {
            $this->dispatchBrowserEvent('pesan', ['isi' => ['Data tidak berhasil disimpan'], 'tipe' => 'error']);
        }
    }

    protected function getData(){
        $this->datas = ModelsDataSekarang::first();
    }

    public function mount(){
        $this->getData();
    }

    public function render()
    {
        // dd($this->datas);
        return view('livewire.admin.data-sekarang')
                    ->extends('layouts.admin', ['page' => 'data-sekarang'])
                    ->section('content');;
    }
}
