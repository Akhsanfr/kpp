<?php

namespace App\Http\Livewire\Admin\Pegawai;

use App\Models\Pegawai;
use Livewire\Component;

class PegawaiForm extends Component
{

    public $pegawai;

    protected $rules = [
        'pegawai.nama' => 'required',
        'pegawai.seksi' => 'required'
    ];

    protected $listeners = ['pegawaiFormSave' => 'save'];

    public function save(){
        $this->validate();
        $this->pegawai->save();
        $this->emit('afterSavingForm');
    }

    public function mount($pegawai_id){
        if($pegawai_id){
            $this->pegawai = Pegawai::find($pegawai_id);
        } else {
            $this->pegawai = new Pegawai();
        }
    }

    public function render()
    {
        return view('livewire.admin.pegawai.pegawai-form');
    }
}
