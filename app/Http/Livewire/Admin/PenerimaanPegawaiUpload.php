<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Pegawai;
use App\Imports\PenerimaanPegawaiImport;
use App\Models\PenerimaanPegawai as ModelsPenerimaanPegawai;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class PenerimaanPegawaiUpload extends Component
{
    use WithFileUploads;

    public $pegawais;

    public $pegawaiId;
    public $file;

    public function unggah()
    {
        try{
            Excel::import(new PenerimaanPegawaiImport($this->pegawaiId), $this->file);
            $this->dispatchBrowserEvent('reset');
            $this->file = '';
            $this->emit('getDataPenerimaanPegawai');
        }catch(ValidationException $e){
            $failures = $e->failures();
            $pesan_isi = [];
            foreach ($failures as $failure) {
                $errs = $failure->errors(); // Get errors
                $row = $failure->row(); // Get baris errors
                foreach($errs as $err){
                    $isi = 'Error pada baris '.$row.', '.$err;
                    array_push($pesan_isi, $isi);
                }
            }
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => $pesan_isi]);
        }
    }

    public function mount(){
        $this->pegawais = Pegawai::all();
    }

    public function render()
    {
        return view('livewire.admin.penerimaan-pegawai-upload');
    }
}
