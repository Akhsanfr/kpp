<?php

namespace App\Http\Livewire;

use App\Imports\PenerimaanImport;
use App\Imports\PenerimaanPegawaiImport;
use App\Models\Pegawai;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

class Admin extends Component
{
    use WithFileUploads;

    public $file;

    public $pegawais;

    protected $listeners = ['unggahData' => 'unggahData'];

    public function unggahData($tabel, $tipe){
        dd('yes');
        if(!$this->file){
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'warning', 'isi' => ['Pilih data terlebih dahulu']]);
            return false;
        }
        try {
            if($tabel == 'penerimaan'){
                Excel::import(new PenerimaanImport($tipe), $this->file);
            } elseif($tabel == 'penerimaanPegawai'){
                Excel::import(new PenerimaanPegawaiImport($tipe), $this->file);
            }
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Unggah data berhasil']]);
            $this->dispatchBrowserEvent('bersihkan');
            $this->file = '';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
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
        return view('livewire.admin');
    }
}
