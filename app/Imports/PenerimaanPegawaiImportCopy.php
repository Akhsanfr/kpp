<?php

namespace App\Imports;

use App\Models\PenerimaanPegawai;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenerimaanPegawaiImportCopy implements ToModel, SkipsEmptyRows, WithValidation, WithBatchInserts
{

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
        'pegawai_id'
    ];

    public function __construct($tipe)
    {
        $this->tipe = $tipe;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        dump($row);
        // $data = [];
        // $data['pegawai_id'] = $this->tipe;
        // foreach($this->columns as $index => $column ){
        //     $data[$column] = $row[$index];
        // }
        // dd('y');
        // return new PenerimaanPegawai($data);
        return new PenerimaanPegawai([
            'tahun' => $row[0],
            'bulan' => $row[1],
            'sp2dk_target' => $row[1],
            'sp2dk_jumlah' => $row[2],
            'lhp2dk_target' => $row[3],
            'lhp2dk_jumlah' => $row[4],
            'lp2dk_realisasi_rupiah' => $row[5],
            'lhpt_target' => $row[6],
            'lhpt_jumlah' => $row[7],
            'sp2dk_terbit_target' => $row[8],
            'sp2dk_terbit_jumlah' => $row[9],
            'lhpt_lhp2dk_target' => $row[10],
            'lhpt_lhp2dk_jumlah' => $row[11],
            'lhp2dk_realisasi_rupiah' => $row[12],
            'stp_terbit_target' => $row[13],
            'stp_terbit_jumlah' => $row[14],
            'stp_terbit_rupiah' => $row[15],
            'pegawai_id' => $this->tipe,
        ]);
    }

    public function rules() : array
    {
        return [
            '0' => [
                'required'
                // Rule::unique('penerimaan_pegawais','periode')->where(function ($query) {
                //     return $query->where('pegawai_id', $this->tipe);
                // })
            ],
            '1' => 'required|integer',
            '2' => 'required|integer',
            '3' => 'required|integer',
            '4' => 'required|integer',
            '5' => 'required|integer',
            '6' => 'required|integer',
            '7' => 'required|integer',
            '8' => 'required|integer',
            '9' => 'required|integer',
            '10' => 'required|integer',
            '11' => 'required|integer',
            '12' => 'required|integer',
            '13' => 'required|integer',
            '14' => 'required|integer',
            '15' => 'required|integer',
            '16' => 'required|integer',
        ];
    }
    public function customValidationAttributes()
    {
        return [
            '0' => 'kolom 1',
            '1' => 'kolom 2',
            '2' => 'kolom 3',
            '3' => 'kolom 4',
            '4' => 'kolom 5',
            '5' => 'kolom 6',
            '6' => 'kolom 7',
            '7' => 'kolom 8',
            '8' => 'kolom 9',
            '9' => 'kolom 10',
            '10' => 'kolom 11',
            '11' => 'kolom 12',
            '12' => 'kolom 13',
            '13' => 'kolom 14',
            '14' => 'kolom 15',
            '15' => 'kolom 16'
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }
}
