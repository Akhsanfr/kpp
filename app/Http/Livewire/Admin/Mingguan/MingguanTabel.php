<?php

namespace App\Http\Livewire\Admin\Mingguan;

use App\Models\Mingguan;
use Livewire\Component;
use Livewire\WithPagination;

class MingguanTabel extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshMingguanTabel',
    ];

    public function refreshMingguanTabel()
    {
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil mengunggah data baru']]);
    }

    // Filter data
    public $search, $paginate = 25, $decimal = 2, $filter_tanggal;
    protected $queryString = [
        'decimal' => ['as' => 'd', 'except' => '2'], // digit desimal
        'search' => ['as'=> 's','except' => ''], // search data
        'paginate' => ['as' => 'pp','except' => '25'], // data per halaman
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
        'edit_data.*.sp2dk_target'=> 'required|numeric',
        'edit_data.*.sp2dk_jumlah'=> 'required|numeric',
        'edit_data.*.lhp2dk_target'=> 'required|numeric',
        'edit_data.*.lhp2dk_jumlah'=> 'required|numeric',
        'edit_data.*.lp2dk_realisasi_rupiah'=> 'required|numeric',
        'edit_data.*.lhpt_target'=> 'required|numeric',
        'edit_data.*.lhpt_jumlah'=> 'required|numeric',
        'edit_data.*.sp2dk_terbit_target'=> 'required|numeric',
        'edit_data.*.sp2dk_terbit_jumlah'=> 'required|numeric',
        'edit_data.*.lhpt_lhp2dk_target'=> 'required|numeric',
        'edit_data.*.lhpt_lhp2dk_jumlah'=> 'required|numeric',
        'edit_data.*.lhp2dk_realisasi_rupiah'=> 'required|numeric',
        'edit_data.*.stp_terbit_target'=> 'required|numeric',
        'edit_data.*.stp_terbit_jumlah'=> 'required|numeric',
        'edit_data.*.stp_terbit_rupiah'=> 'required|numeric'
    ];

    // get data yang akan diedit
    public function edit($id)
    {
        $this->edit_mode = true;
        $this->edit_data = Mingguan::with('pegawai')->where('id', $id)->get();
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
        Mingguan::destroy($id);
        $this->emit('refreshHarianCek');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus data']]);
    }

    // hapus semua data
    public function hapusAll()
    {
        Mingguan::truncate();
        $this->emit('refreshHarianCek');
        $this->dispatchBrowserEvent('pesan', ['tipe' => 'success', 'isi' => ['Berhasil menghapus semua data']]);
    }

    public function render()
    {
        if ($this->edit_mode) {
            // return array kosong jika sedang dalam mode edit
            $mingguans = [];
        } else {
            $mingguans = Mingguan
                ::with('pegawai')
                ->where('sp2dk_target', 'like', '%' . $this->search . '%')
                ->orWhere('sp2dk_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('lhp2dk_target', 'like', '%' . $this->search . '%')
                ->orWhere('lhp2dk_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('lp2dk_realisasi_rupiah', 'like', '%' . $this->search . '%')
                ->orWhere('lhpt_target', 'like', '%' . $this->search . '%')
                ->orWhere('lhpt_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('sp2dk_terbit_target', 'like', '%' . $this->search . '%')
                ->orWhere('sp2dk_terbit_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('lhpt_lhp2dk_target', 'like', '%' . $this->search . '%')
                ->orWhere('lhpt_lhp2dk_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('lhp2dk_realisasi_rupiah', 'like', '%' . $this->search . '%')
                ->orWhere('stp_terbit_target', 'like', '%' . $this->search . '%')
                ->orWhere('stp_terbit_jumlah', 'like', '%' . $this->search . '%')
                ->orWhere('stp_terbit_rupiah', 'like', '%' . $this->search . '%')
                ->paginate($this->paginate);
        }

        return view('livewire.admin.mingguan.mingguan-tabel', compact('mingguans'))
            ->extends('layouts.admin')
            ->section('content');
    }
}
