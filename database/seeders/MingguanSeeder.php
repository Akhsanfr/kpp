<?php

namespace Database\Seeders;

use App\Models\Mingguan;
use Illuminate\Database\Seeder;

class MingguanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $columns = [
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
            'stp_terbit_rupiah'
        ];
        for($i = 1; $i <= 15; $i++){
            for($tahun = 2020; $tahun <= 2022; $tahun++){
                for($bulan = 1; $bulan <= 12; $bulan++){
                    for($pekan = 1; $pekan <= 5; $pekan++){
                        $data = [];
                        foreach($columns as $column){
                            $data[$column] = rand(1000,1000000);
                            // $data[$column] = 1000;
                        }
                        $data['tahun'] = $tahun;
                        $data['bulan'] = $bulan;
                        $data['pekan'] = $pekan;
                        $data['pegawai_id'] = $i;
                        Mingguan::create($data);
                    }
                }
            }
        }
    }
}
