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
            'target' => 10000000000000.12345
        ]);
        Tahunan::create([
            'tahun' => 2021,
            'target' => 1500.12345
        ]);
    }
}
