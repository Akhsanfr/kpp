<?php

namespace App\Http\Livewire\Admin\Pegawai;

use App\Models\Mingguan;
use App\Models\Pegawai;
use Livewire\Component;

class PegawaiTabel extends Component
{

    public $pegawais;

    public function edit($pegawai_id){
        $this->emit('switchComponent', 'form', $pegawai_id);
    }

    public function delete($id){
        if(Mingguan::where('pegawai_id', $id)->first()){
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => ['Gagal menghapus data, terdapat data mingguan dengan pegawai yang akan dihapus']]);
        } else {
            Pegawai::destroy($id);
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus data']]);
        }
    }

    public function render()
    {
        $this->pegawais = Pegawai::all();
        return view('livewire.admin.pegawai.pegawai-tabel');
    }
}
