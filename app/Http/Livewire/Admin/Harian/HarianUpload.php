<?php

namespace App\Http\Livewire\Admin\Harian;

use App\Imports\HariansImport;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class HarianUpload extends Component
{
    use WithFileUploads;

    public $file;

    public function unggah()
    {
        try {
            Excel::import(new HariansImport(), $this->file);
            $this->file = '';
            $this->dispatchBrowserEvent('reset'); // reset data tampilan js
            $this->emit('refreshHarianTabel'); // refresh tabel
            $this->emit('refreshHarianCek');
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

    public function render()
    {
        return view('livewire.admin.harian.harian-upload');
    }
}
