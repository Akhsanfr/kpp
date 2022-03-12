<?php

namespace App\Imports;

use App\Models\Harian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class HariansImport implements ToModel, WithValidation, WithBatchInserts
{

    protected $tipe;

    protected $columns = [
        'tanggal',
        'ppn_impor',
        'pph_25_9',
        'pph_22_impor',
        'pph_21',
        'pph_ppndn',
        'pph_23',
        'pph_22',
        'netto',
        'bruto',
    ];

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $datas = [];
        foreach ($this->columns as $index => $data) {
            $datas[$data] = $row[$index];
        }
        return new Harian($datas);
    }

    public function rules(): array
    {
        $rules = [];
        foreach ($this->columns as $index => $data) {
            $rules[$index] = ['required', 'numeric'];
        }
        $rules['0'] = [
            'date_format:Y-m-d',
            'required',
            'unique:App\Models\Harian,tanggal',
        ];
        return $rules;
    }

    public function customValidationAttributes()
    {

        $attrs = [];

        foreach ($this->columns as $index => $data) {
            $attrs[$index] = $data;
        }

        return $attrs;

    }

    public function batchSize(): int
    {
        return 1000;
    }

}
