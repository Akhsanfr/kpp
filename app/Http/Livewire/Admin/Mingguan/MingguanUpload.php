<?php

namespace App\Http\Livewire\Admin\Mingguan;

use Livewire\Component;
use App\Imports\MingguansImport;
use App\Models\Pegawai;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;


class MingguanUpload extends Component
{

     use WithFileUploads;

    public $file, $pegawais;

    public function unggah($pegawai_id)
    {
        try {
            Excel::import(new MingguansImport($pegawai_id), $this->file);
            $this->file = '';
            $this->dispatchBrowserEvent('reset'); // reset data tampilan js
            $this->emit('refreshMingguanTabel'); // refresh tabel
            $this->emit('refreshMingguanCek');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $pesan_isi = [];
            foreach ($failures as $failure) {
                $errs = $failure->errors(); // Get errors
                $row = $failure->row(); // Get baris errors
                foreach ($errs as $err) {
                    $isi = 'Error pada baris ' . $row . ', ' . $err;
                    array_push($pesan_isi, $isi);
                }
            }
            $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => $pesan_isi]);
        }
    }

    public function mount(){
        $this->pegawais = Pegawai::orderBy('nama')->get();
    }

    public function render()
    {
        return view('livewire.admin.mingguan.mingguan-upload');
    }
}
