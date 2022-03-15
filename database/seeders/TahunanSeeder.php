<?php

namespace Database\Seeders;

use App\Models\Tahunan;
use Illuminate\Database\Seeder;

class TahunanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tahunan::create([
            'tahun' => 2020,
            'target' => bcmul(rand(100000000, 2000000000), 365)
        ]);
        Tahunan::create([
            'tahun' => 2021,
            'target' => bcmul(rand(100000000, 2000000000), 365)
        ]);
        Tahunan::create([
            'tahun' => 2022,
            'target' => bcmul(rand(100000000, 2000000000), 365)
        ]);
    }
}
