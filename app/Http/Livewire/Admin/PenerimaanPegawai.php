<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\PenerimaanPegawai as ModelPenerimaanPegawai;

class PenerimaanPegawai extends Component
{

    // public function unggahBerkas($pegawai_id)
    // {
    //     try{
    //         Excel::import(new PenerimaanPegawaiImport($pegawai_id), $this->file);
    //         $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Unggah data berhasil']]);
    //         $this->dispatchBrowserEvent('reset');
    //         $this->file = '';
    //         $this->getData();
    //     }catch(ValidationException $e){
    //         $failures = $e->failures();
    //         $pesan_isi = [];
    //         foreach ($failures as $failure) {
    //             $errs = $failure->errors(); // Get errors
    //             $row = $failure->row(); // Get baris errors
    //             foreach($errs as $err){
    //                 $isi = 'Error pada baris '.$row.', '.$err;
    //                 array_push($pesan_isi, $isi);
    //             }
    //         }
    //         $this->dispatchBrowserEvent('reset');
    //         $this->dispatchBrowserEvent('pesan', ['tipe' => 'error', 'isi' => $pesan_isi]);
    //         $this->file = '';
    //     }
    // }

    // === EDIT === //
    public $edit_mode;
     protected $rules = [
        'edit_data.*.pegawai_id' => 'required',
        'edit_data.*.tahun' => 'required',
        'edit_data.*.bulan' => 'required',
        'edit_data.*.pekan' => 'required',
        'edit_data.*.sp2dk_target' => 'required',
        'edit_data.*.sp2dk_jumlah' => 'required',
        'edit_data.*.lhp2dk_target' => 'required',
        'edit_data.*.lhp2dk_jumlah' => 'required',
        'edit_data.*.lp2dk_realisasi_rupiah' => 'required',
        'edit_data.*.lhpt_target' => 'required',
        'edit_data.*.lhpt_jumlah' => 'required',
        'edit_data.*.sp2dk_terbit_target' => 'required',
        'edit_data.*.sp2dk_terbit_jumlah' => 'required',
        'edit_data.*.lhpt_lhp2dk_target' => 'required',
        'edit_data.*.lhpt_lhp2dk_jumlah' => 'required',
        'edit_data.*.lhp2dk_realisasi_rupiah' => 'required',
        'edit_data.*.stp_terbit_target' => 'required',
        'edit_data.*.stp_terbit_jumlah' => 'required',
        'edit_data.*.stp_terbit_rupiah' => 'required',
    ];
    public function edit($id){
        $this->edit_mode = true;
        $this->edit_data = ModelPenerimaanPegawai::whereIn('id', $id)->get();
    }
    public function edit_simpan(){
        $this->validate();
        foreach ($this->edit_data as $data) {
            $data->save();
        }
        $this->edit_mode = false;
        $this->getData();
    }

    // === SELECT === //
    public $penerimaans;
    public $p = 1;
    public $l = 25;
    public $s = "";
    protected $queryString = [
        "p" => ['except' => 1],
        "l" => ['except' => 25],
        "s" => ['except' => '']
    ];
    public function setPage($p){
        $this->p = $p;
        $this->getData();
    }
    public function updatedL(){
        $this->p = 1;
        $this->getData();
    }
    public function updatedS(){
        $this->getData();
    }
    public function getDataWithPagination($model, $limit, $page){
        $data = [];
        $offset = ($page - 1) * $limit;

        if($this->s !== ''){
            $query = $model
                ::where('tahun', 'like', "%$this->s%")
                ->orWhere('bulan', 'like', "%$this->s%")
                ->orWhere('pekan', 'like', "%$this->s%")
                ->orWhere('sp2dk_target', 'like', "%$this->s%")
                ->orWhere('sp2dk_jumlah', 'like', "%$this->s%")
                ->orWhere('lhp2dk_target', 'like', "%$this->s%")
                ->orWhere('lhp2dk_jumlah', 'like', "%$this->s%")
                ->orWhere('lp2dk_realisasi_rupiah', 'like', "%$this->s%")
                ->orWhere('lhpt_target', 'like', "%$this->s%")
                ->orWhere('lhpt_jumlah', 'like', "%$this->s%")
                ->orWhere('sp2dk_terbit_target', 'like', "%$this->s%")
                ->orWhere('sp2dk_terbit_jumlah', 'like', "%$this->s%")
                ->orWhere('lhpt_lhp2dk_target', 'like', "%$this->s%")
                ->orWhere('lhpt_lhp2dk_jumlah', 'like', "%$this->s%")
                ->orWhere('lhp2dk_realisasi_rupiah', 'like', "%$this->s%")
                ->orWhere('stp_terbit_target', 'like', "%$this->s%")
                ->orWhere('stp_terbit_jumlah', 'like', "%$this->s%")
                ->orWhere('stp_terbit_rupiah', 'like', "%$this->s%");
            $data['jumlah_row'] = $query->count();
            $data['data'] = $query->offset($offset)->limit($limit)->get();
        } else {
            $data['jumlah_row'] = $model::count();
            $data['data'] = $model::with('pegawai')->offset($offset)->limit($limit)->get();
        }
        $data['jumlah_page'] = intval(ceil($data['jumlah_row']/$limit));
        $data['page'] = $page;
        // data row perhalaman
        $data['row_awal'] = (($page -1 ) * $limit ) + 1;
        if($data['page'] === $data['jumlah_page']){
            $data['row_akhir'] = $data["jumlah_row"];
        } else {
            $data['row_akhir'] = (($page -1 ) * $limit ) + $limit;
        }

        return $data;
    }
    protected function getData(){
        $this->penerimaans = $this->getDataWithPagination(ModelPenerimaanPegawai::class, $this->l, $this->p);
    }
     // === DELETE DATA === //

    public function hapus(array $id){
        ModelPenerimaanPegawai::destroy($id);
        $this->getData();
    }

    public function hapusAll(){
        ModelPenerimaanPegawai::truncate();
        $this->getData();
    }

    public function reloadAfterUploadNewData(){
        $this->getData();
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Unggah data berhasil']]);
    }
    protected $listeners = ['getDataPenerimaanPegawai' => 'reloadAfterUploadNewData'];

    public function mount(){
        $this->getData();
    }

    public function render()
    {

        return view('livewire.admin.penerimaan-pegawai')
                    ->extends('layouts.admin', ['page' => 'penerimaan-pegawai'])
                    ->section('content');
    }
}
