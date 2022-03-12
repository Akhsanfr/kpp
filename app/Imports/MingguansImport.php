<?php

namespace App\Imports;

use App\Models\Mingguan;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class MingguansImport implements ToModel, WithValidation, WithBatchInserts
{

    protected $pegawai_id;

    protected $columns = [
        'tahun',
        'bulan',
        'pekan',
        'sp2dk_target',
        'sp2dk_jumlah',
        'lhp2dk_target',
        'lhp2dk_jumlah',
        'lp2dk_realisasi_rupiah',
        'lhpt_target',
        'lhpt_jumlah',
        'sp2dk_terbit_target',
        'sp2dk_terbit_jumlah',
        'lhpt_lhp2dk_target',
        'lhpt_lhp2dk_jumlah',
        'lhp2dk_realisasi_rupiah',
        'stp_terbit_target',
        'stp_terbit_jumlah',
        'stp_terbit_rupiah',
    ];

    public function __construct($pegawai_id)
    {
        $this->pegawai_id = $pegawai_id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $datas = [];
        foreach($this->columns as $index => $data){
            $datas[$data] = $row[$index];
        }
        $datas['pegawai_id'] = $this->pegawai_id;
        return new Mingguan($datas);
    }

    public function rules(): array
    {
        $rules = [];
        foreach($this->columns as $index => $data){
            $rules[$index] = ['required', 'numeric'];
        }
        $rules['0'] = ['required', 'size:4'];
        $rules['1'] = ['required', 'size:2'];
        $rules['2'] = [
                'required',
                // Rule::unique('penerimaan_pegawais','pekan')->where(function ($query) use ($tahun, $bulan, $pegawai_id) {
                //     return $query
                //         ->where('tahun', $tahun)
                //         ->where('bulan', $bulan)
                //         ->where('pegawai_id', $this->pegawai_id);
                // }),
                // Rule::unique('penerimaan_pegawais', 'pekan', 'tahun', 'bulan', 'pegawai_id'),
                Rule::in(['1', '2', '3', '4', '5']),
        ];
        return $rules;
    }

    public function customValidationAttributes()
    {

        $attrs = [];

        foreach($this->columns as $index => $data){
            $attrs[$index] = $data;
        }

        return $attrs;

    }



    public function batchSize(): int
    {
        return 1000;
    }

}
