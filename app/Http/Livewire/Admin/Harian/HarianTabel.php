<?php

namespace App\Http\Livewire\Admin\Harian;

use App\Models\Harian as HarianModel;
use Livewire\Component;
use Livewire\WithPagination;

class HarianTabel extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshHarianTabel',
        'filterSearch'
    ];

    public function refreshHarianTabel()
    {
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil mengunggah data baru']]);
    }

    public function filterSearch($val){
        $this->search = $val;
    }

    // Filter data
    public $search, $paginate = 25, $decimal = 2, $filter_tanggal;
    protected $queryString = [
        'decimal' => ['as' => 'd', 'except' => 2], // digit desimal
        'search' => ['as'=> 's','except' => ''], // search data
        'paginate' => ['as' => 'pp','except' => 25], // data per halaman
        'page' => ['as' => 'p'], // halaman
    ];

    // reset data pagination jika sedang mengedit search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // === edit area === //
    public $edit_mode;
    // data yang akan diedit
    public $edit_data;
    protected $rules = [
        'edit_data.*.ppn_impor' => 'required|numeric',
        'edit_data.*.pph_25_9' => 'required',
        'edit_data.*.pph_22_impor' => 'required',
        'edit_data.*.pph_21' => 'required',
        'edit_data.*.pph_ppndn' => 'required',
        'edit_data.*.pph_23' => 'required',
        'edit_data.*.pph_22' => 'required',
        'edit_data.*.netto' => 'required',
        // 'edit_data.*.bruto' => 'required',

    ];

    // get data yang akan diedit
    public function edit($id)
    {
        $this->edit_mode = true;
        $this->edit_data = HarianModel::find($id);
    }

    // update data yang sedang diedit
    public function edit_simpan()
    {
        $this->validate();
        foreach ($this->edit_data as $data) {
            $data->save();
        }
        $this->edit_mode = false;
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil merubah data']]);
    }

    // hapus data yang dipilih
    public function hapus($id)
    {
        HarianModel::destroy($id);
        $this->emit('refreshHarianCek');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus data']]);
    }

    // hapus semua data
    public function hapusAll()
    {
        HarianModel::truncate();
        $this->emit('refreshHarianCek');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus semua data']]);
    }

    public function render()
    {
        if ($this->edit_mode) {
            // return array kosong jika sedang dalam mode edit
            $harians = [];
        } else {
            $harians = HarianModel
                ::where('tanggal', 'like', '%' . $this->search . '%')
                ->orWhere('ppn_impor', 'like', '%' . $this->search . '%')
                ->orWhere('pph_25_9', 'like', '%' . $this->search . '%')
                ->orWhere('pph_22_impor', 'like', '%' . $this->search . '%')
                ->orWhere('pph_21', 'like', '%' . $this->search . '%')
                ->orWhere('pph_ppndn', 'like', '%' . $this->search . '%')
                ->orWhere('pph_23', 'like', '%' . $this->search . '%')
                ->orWhere('pph_22', 'like', '%' . $this->search . '%')
                ->orWhere('netto', 'like', '%' . $this->search . '%')
                // ->orWhere('bruto', 'like', '%' . $this->search . '%')
                ->orderBy('tanggal')
                ->paginate($this->paginate);
        }

        return view('livewire.admin.harian.harian-tabel', compact('harians'))
            ->extends('layouts.admin', ['page' => 'harian'])
            ->section('content');
    }
}
