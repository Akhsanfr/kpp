<?php

namespace App\Http\Livewire\Admin\Pegawai;

use App\Models\Pegawai as ModelsPegawai;
use Livewire\Component;

class PegawaiIndex extends Component
{
    public $pegawais = [];
    public $component = 'tabel';
    public $pegawai_id;

    protected $queryString = [
        'component' => ['as' => 'c', 'except' => 'tabel']
    ];

    public function switchComponent($component, $pegawai_id = ''){
        $this->component = $component;
        $this->pegawai_id = $pegawai_id;
    }

    protected $listeners = [
        'afterSavingForm',
        'switchComponent'
    ];

    public function afterSavingForm(){
        $this->switchComponent('tabel');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menyimpan data']]);
    }

    // public function getData(){
        //  $seksis = [
        //     'Pengawasan I',
        //     'Pengawasan II',
        //     'Pengawasan III',
        //     'Pengawasan IV',
        //     'Pengawasan V',
        //     'Pengawasan VI',
        // ];
        // $this->pegawais = ModelsPegawai::all();
        // foreach($seksis as $seksi){
        //     $this->pegawais[$seksi] = $pegawais->where('seksi',$seksi);
        // }
        // $this->pegawais[] = $pegawais->where('seksi','Pengawasan II');
        // $this->pegawais[] = $pegawais->where('seksi','Pengawasan III');
        // $this->pegawais[] = $pegawais->where('seksi','Pengawasan IV');
        // $this->pegawais[] = $pegawais->where('seksi','Pengawasan V');
        // $this->pegawais[] = $pegawais->where('seksi','Pengawasan VI');
    // }

    public function mount(){
        // $this->getData();
         $this->pegawais = ModelsPegawai::all();
    }

    // public function tambah($nama, $seksi, $is_active, $id = 0){
    //     if($id == 0){
    //         $pegawai = new ModelsPegawai();
    //     } else {
    //         $pegawai = ModelsPegawai::find($id);
    //     }
    //     $pegawai->nama = $nama;
    //     $pegawai->seksi = $seksi;
    //     $pegawai->is_active = $is_active;
    //     if($pegawai->save()){
    //        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Data berhasil disimpan']]);
    //        $this->dispatchBrowserEvent('done');
    //        $this->getData();
    //     } else {
    //        $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => ['Terdapat kesalahan']]);
    //     }
    // }

    // public function hapus($id){
    //     $pegawai = ModelsPegawai::find($id);
    //     $nama = $pegawai->nama;
    //     if($pegawai->delete()){
    //         $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ["Data $nama berhasil dihapus"]]);
    //         $this->dispatchBrowserEvent('done');
    //         $this->getData();
    //     } else {
    //         $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => ['Terdapat kesalahan']]);
    //     }
    // }

    public function render()
    {
        return view('livewire.admin.pegawai.pegawai-index')->extends('layouts.admin');
    }
}
