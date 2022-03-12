<?php

namespace App\Http\Livewire\Admin\Mingguan;

use App\Models\Mingguan;
use App\Models\Pegawai;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MingguanCek extends Component
{
    public $mingguans;
    public $pegawais;
    public $bulans = [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Dessember"
    ];

    protected $listeners = ['refreshMingguanCek' => '$refresh'];

    public $seksi = 'Semua';
    public $tahun;
    protected $queryString = [
        'tahun' => ['as' => 'ct'],
        'seksi' => ['as' => 'cs', 'except' => 'Semua']
    ];

    public function mount(){
        $this->tahun = date('Y');
        $this->queryString['tahun']['except'] = date('Y');
    }
    public function render()
    {
        $mingguans = Mingguan
            ::select(DB::raw("concat(pegawai_id,'-',bulan,'-', pekan) as data_pegawai"))
            ->where('tahun', $this->tahun);
        if($this->seksi !== 'Semua'){
            $mingguans->whereHas('pegawai', function (Builder $pegawai){
                $pegawai->where('seksi', $this->seksi);
            });
            $this->pegawais = Pegawai::where('seksi', $this->seksi)->get();
        } else {
            $this->pegawais = Pegawai::all();
        }
        $this->mingguans = $mingguans->get()->pluck('data_pegawai')->toArray();

        return view('livewire.admin.mingguan.mingguan-cek');
    }
}
