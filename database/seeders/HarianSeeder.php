<?php

namespace Database\Seeders;

use App\Models\Harian;
use Illuminate\Database\Seeder;

class HarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($year=2020; $year <= 2022; $year++) {
            $end_year = $year + 1;
            $period = new \DatePeriod(
                new \DateTime("$year-01-01"),
                new \DateInterval('P1D'),
                new \DateTime("$end_year-01-01")
            );
            foreach($period as $tanggal){

                $val = [];
                $bruto = 0;
                for ($i=1; $i <= 7; $i++) {
                    $rand = rand(100000000, 1000000000);
                    array_push($val, $rand);
                    $bruto += $rand;
                }

                $koloms = [
                    'ppn_impor',
                    'pph_25_9',
                    'pph_22_impor',
                    'pph_21',
                    'pph_ppndn',
                    'pph_23',
                    'pph_22',
                ];

                $input = [];
                foreach($koloms as $key => $kolom){
                    $input[$kolom] = $val[$key];
                }
                $input['tanggal'] = $tanggal;
                $input['bruto'] = $bruto;
                $input['netto'] = $bruto * bcdiv(rand(1,20), 10);
                Harian::create($input);
            }
        }
    }
}
