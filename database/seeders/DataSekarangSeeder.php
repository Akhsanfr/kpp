<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DataSekarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('data_sekarangs')->insert([
            'peringkat_kpp_kanwil' => '10/100',
            'peringkat_kpp_nonpratama' => '10/100',
            'peringkat_kpp_nasional' => '10/100',
            'peringkat_pajak_1' => 'Batu bara',
            'peringkat_pajak_2' => 'Sosis',
            'peringkat_pajak_3' => 'Kuaci'
        ]);
    }
}
