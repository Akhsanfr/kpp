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
        DB::table('pegawais')->insert([
            'nama' => 'Juan Rich',
            'seksi' => 'Pengawasan III',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Ricky Flamboyan',
            'seksi' => 'Pengawasan II',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Ignasius Rifany',
            'seksi' => 'Pengawasan IV',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Jaka Samudra',
            'seksi' => 'Pengawasan V',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Barnet Ikoes',
            'seksi' => 'Pengawasan IV',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Joseph Sink',
            'seksi' => 'Pengawasan III',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Ahmad Yasin',
            'seksi' => 'Pengawasan II',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Jons Kiwi',
            'seksi' => 'Pengawasan IV',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Azka Rizkia',
            'seksi' => 'Pengawasan V',
        ]);
        DB::table('pegawais')->insert([
            'nama' => 'Nurina',
            'seksi' => 'Pengawasan IV',
        ]);
    }
}
