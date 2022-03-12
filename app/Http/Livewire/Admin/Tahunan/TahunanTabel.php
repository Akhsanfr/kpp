<?php

namespace App\Http\Livewire\Admin\Tahunan;

use Livewire\Component;
use App\Models\Tahunan;

class TahunanTabel extends Component
{

    public $tahunans;

    public function edit($tahunan_id){
        $this->emit('switchComponent', 'form', $tahunan_id);
    }

    public function delete($id){
        Tahunan::destroy($id);
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus data']]);
    }

    public function render()
    {
        $this->tahunans = Tahunan::all();
        return view('livewire.admin.tahunan.tahunan-tabel');
    }
}
