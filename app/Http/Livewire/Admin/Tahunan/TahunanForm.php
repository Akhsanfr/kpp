<?php

namespace App\Http\Livewire\Admin\Tahunan;

use App\Models\Tahunan;
use Livewire\Component;

class TahunanForm extends Component
{

    public $tahunan;

    protected $rules = [
        'tahunan.tahun' => 'required',
        'tahunan.target' => 'required|numeric'
    ];

    protected $listeners = ['tahunanFormSave' => 'save'];

    public function save(){
        if(!$this->tahunan->id){
            $this->rules['tahunan.tahun'] = 'required|unique:App\Models\Tahunan,tahun';
        }
        $this->validate();
        $this->tahunan->save();
        $this->emit('afterSavingForm');
    }

    public function mount($tahunan_id){
        if($tahunan_id){
            $this->tahunan = Tahunan::find($tahunan_id);

        } else {
            $this->tahunan = new Tahunan();
        }
    }

    public function render()
    {
        return view('livewire.admin.tahunan.tahunan-form');
    }
}
