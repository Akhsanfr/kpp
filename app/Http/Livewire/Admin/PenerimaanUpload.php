<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\PenerimaanImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class PenerimaanUpload extends Component
{
    use WithFileUploads;
    public $file, $type;

    public function unggah()
    {
        try{
            Excel::import(new PenerimaanImport($this->type), $this->file);
            $this->file = '';
            $this->dispatchBrowserEvent('reset');
            $this->emit('getDataPenerimaan');
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

    public function render()
    {
        return view('livewire.admin.penerimaan-upload');
    }
}
