<?php

namespace App\Imports;

use App\Models\Penerimaan;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class PenerimaanImportCopy implements ToModel, SkipsEmptyRows, WithValidation, WithBatchInserts
{
    use Importable;

    public function __construct($tipe)
    {
        $this->tipe = $tipe;
    }

    public function model(array $row)
    {
        return new Penerimaan([
            'tanggal'=> $row[0],
            'ppn_impor'=> $row[1],
            'pph_25_9'=> $row[2],
            'pph_22_impor'=> $row[3],
            'pph_21'=> $row[4],
            'pph_ppndn'=> $row[5],
            'pph_23'=> $row[6],
            'pph_22'=> $row[7],
            'netto'=> $row[8],
            'bruto'=> $row[9],
            'capaian_netto'=> $row[10],
            'capaian_bruto'=> $row[11],
            'penerimaan_target'=> $row[12],
            'penerimaan_netto'=> $row[13],
            'penerimaan_spmkp'=> $row[14],
            'tipe'=> $this->tipe,
        ]);
    }

    public function rules() : array
    {
        return [
            '0' => [
                'date_format:Y-m-d',
                'required',
                Rule::unique('penerimaans','tanggal')->where(function ($query) {
                    return $query->where('tipe', $this->tipe);
                })
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
        ];
    }
    public function customValidationMessages()
    {
        return [
            '0.date_format' => 'Format tanggal tidak sesuai ketentuan (yyyy-mm-dd).',
        ];
    }
    public function customValidationAttributes()
    {
        return [
            '0' => 'Tanggal',
            '1' => 'PPN Impor',
            '2' => 'PPH 25/9',
            '3' => 'PPH 22 Impor',
            '4' => 'PPH 21',
            '5' => 'PPH PPNDN',
            '6' => 'PPH 23',
            '7' => 'PPH 22',
            '8' => 'Netto',
            '9' => 'Bruto',
            '10' => 'Capaian Netto',
            '11' => 'Capaian Bruto',
        ];
    }
    public function batchSize(): int
    {
        return 1000;
    }

}


