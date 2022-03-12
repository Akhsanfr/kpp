<?php

namespace App\Http\Livewire\Admin;

use App\Models\Penerimaan as ModelPenerimaan;
use Livewire\Component;

class Penerimaan extends Component
{

    // === CREATE DATA === //
    // public $file;
    public $edit_mode = false;

    // === EDIT DATA === //
    public $edit_data;
    protected $rules = [
        'edit_data.*.tanggal' => 'required',
        'edit_data.*.ppn_impor' => 'required',
        'edit_data.*.pph_25_9' => 'required',
        'edit_data.*.pph_22_impor' => 'required',
        'edit_data.*.pph_21' => 'required',
        'edit_data.*.pph_ppndn' => 'required',
        'edit_data.*.pph_23' => 'required',
        'edit_data.*.pph_22' => 'required',
        'edit_data.*.pertumbuhan_netto' => 'required',
        'edit_data.*.pertumbuhan_bruto' => 'required',
        'edit_data.*.capaian_netto' => 'required',
        'edit_data.*.capaian_bruto' => 'required',
        'edit_data.*.penerimaan_target' => 'required',
        'edit_data.*.penerimaan_netto' => 'required',
        'edit_data.*.penerimaan_spmkp' => 'required',
        'edit_data.*.tipe' => 'required',
    ];
    public function edit($id)
    {
        $this->edit_mode = true;
        $this->edit_data = ModelPenerimaan::whereIn('id', $id)->get();
    }
    public function edit_simpan()
    {
        $this->validate();
        // dd('edit');
        foreach ($this->edit_data as $data) {
            $data->save();
        }
        $this->edit_mode = false;
        $this->getData();
    }

    // === DELETE DATA === //

    public function hapus(array $id)
    {
        ModelPenerimaan::destroy($id);
        $this->getData();
    }

    public function hapusAll()
    {
        ModelPenerimaan::truncate();
        $this->getData();
    }

    // === SHOW DATA === //

    public $penerimaans;
    public $p = 1;
    public $l = 25;
    public $s = "";
    public $tes = "y";
    protected $queryString = [
        "p" => ['except' => 1],
        "l" => ['except' => 25],
        "s" => ['except' => ''],
    ];
    public function setPage($p)
    {
        $this->p = $p;
        $this->getData();
    }
    public function updatedL()
    {
        $this->p = 1;
        $this->getData();
    }
    public function updatedS()
    {
        $this->getData();
    }
    public function getDataWithPagination($model, $limit, $page)
    {
        $data = [];
        $offset = ($page - 1) * $limit;

        if ($this->s !== '') {
            $query = $model
                ::where('tanggal', 'like', "%$this->s%")
                ->orWhere('ppn_impor', 'like', "%$this->s%")
                ->orWhere('pph_25_9', 'like', "%$this->s%")
                ->orWhere('pph_22_impor', 'like', "%$this->s%")
                ->orWhere('pph_21', 'like', "%$this->s%")
                ->orWhere('pph_ppndn', 'like', "%$this->s%")
                ->orWhere('pph_23', 'like', "%$this->s%")
                ->orWhere('pph_22', 'like', "%$this->s%")
                ->orWhere('pertumbuhan_netto', 'like', "%$this->s%")
                ->orWhere('pertumbuhan_bruto', 'like', "%$this->s%")
                ->orWhere('capaian_netto', 'like', "%$this->s%")
                ->orWhere('capaian_bruto', 'like', "%$this->s%")
                ->orWhere('penerimaan_target', 'like', "%$this->s%")
                ->orWhere('penerimaan_netto', 'like', "%$this->s%")
                ->orWhere('penerimaan_spmkp', 'like', "%$this->s%")
            ;
            $data['jumlah_row'] = $query->count();
            $data['data'] = $query->offset($offset)->limit($limit)->get();
        } else {
            $data['jumlah_row'] = $model::count();
            $data['data'] = $model::offset($offset)->limit($limit)->get();
        }
        $data['jumlah_page'] = intval(ceil($data['jumlah_row'] / $limit));
        $data['page'] = $page;
        // data row perhalaman
        $data['row_awal'] = (($page - 1) * $limit) + 1;
        if ($data['page'] === $data['jumlah_page']) {
            $data['row_akhir'] = $data["jumlah_row"];
        } else {
            $data['row_akhir'] = (($page - 1) * $limit) + $limit;
        }

        return $data;
    }
    protected function getData()
    {
        $this->penerimaans = $this->getDataWithPagination(ModelPenerimaan::class, $this->l, $this->p);
    }

    public function reloadAfterUploadNewData()
    {
        $this->getData();
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Unggah data berhasil']]);
    }

    protected $listeners = ['getDataPenerimaan' => 'reloadAfterUploadNewData'];

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.admin.penerimaan')
            ->extends('layouts.admin', ['page' => 'penerimaan'])
            ->section('content');
    }
}
