<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            'nama' => 'Fernanda Akhsanuddin Almas',
            'seksi' => 'Pengawasan I',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Kasdoelah',
            'seksi' => 'Pengawasan I',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Siti Munaroh',
            'seksi' => 'Pengawasan I',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Taufik Hidayat',
            'seksi' => 'Pengawasan II',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Steven Julian',
            'seksi' => 'Pengawasan IV',
        ]);
    }
}
