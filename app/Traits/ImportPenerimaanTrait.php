<?php
namespace App\Traits;

use App\Imports\PenerimaanImport;
use App\Imports\PenerimaanPegawaiImport;
use Maatwebsite\Excel\Facades\Excel;

trait ImportPenerimaanTrait {

    protected function unggahDataPenerimaan(){
        dd('yes - unggah ');
    }

    protected function unggahDataPenerimaanPegawai($file, $pegawai_id){
        $this->unggahData('penerimaanPegawai', $pegawai_id);
    }

    protected function unggahData($tabel, $tipe){
        try {
            Excel::import(new PenerimaanPegawaiImport($tipe), $this->file);
            dump('sukses');
        //     if($tabel == 'penerimaan'){
        //         Excel::import(new PenerimaanImport($tipe), $this->file);
        //     } elseif($tabel == 'penerimaanPegawai'){
        //         Excel::import(new PenerimaanPegawaiImport($tipe), $this->file);
        //     }

        //     return 'sukses';
            // $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Unggah data berhasil']]);
            // $this->dispatchBrowserEvent('bersihkan');
            // $this->file = '';
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            dd($failures);
            $pesan_isi = [];
            foreach ($failures as $failure) {
                $errs = $failure->errors(); // Get errors
                $row = $failure->row(); // Get baris errors
                foreach($errs as $err){
                    $isi = 'Error pada baris '.$row.', '.$err;
                    array_push($pesan_isi, $isi);
                }
            }
            return $pesan_isi;
            // $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => $pesan_isi]);
        }

    }
}
