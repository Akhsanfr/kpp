<?php

namespace Database\Seeders;

use App\Models\Lifetime;
use Illuminate\Database\Seeder;

class LifetimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lifetime::create([
            'peringkat_kpp_kanwil' => '1',
            'peringkat_kpp_non_pratama' => '3',
            'peringkat_kpp_nasional' => '4',
            'sektor_pajak_bruto_terbesar_1' => 'Sosis',
            'sektor_pajak_bruto_terbesar_2' => 'Bakso',
            'sektor_pajak_bruto_terbesar_3' => 'Cimol',
            'sektor_wp_tertinggi_1' => 'Tuan Muda Ali',
            'sektor_wp_tertinggi_2' => 'Av',
            'sektor_wp_tertinggi_3' => 'Ily',
            'sektor_wp_tertinggi_4' => 'Bibi Gill',
            'sektor_wp_tertinggi_5' => 'Miss Keriting',
        ]);
    }
}
