<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMingguansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mingguans', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->enum('bulan', [1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->enum('pekan', [1,2,3,4,5]);
            $table->double('sp2dk_target', 25, 5);
            $table->double('sp2dk_jumlah', 25, 5);
            $table->double('lhp2dk_target', 25, 5);
            $table->double('lhp2dk_jumlah', 25, 5);
            $table->double('lp2dk_realisasi_rupiah', 25, 5);
            $table->double('lhpt_target', 25, 5);
            $table->double('lhpt_jumlah', 25, 5);
            $table->double('sp2dk_terbit_target', 25, 5);
            $table->double('sp2dk_terbit_jumlah', 25, 5);
            $table->double('lhpt_lhp2dk_target', 25, 5);
            $table->double('lhpt_lhp2dk_jumlah', 25, 5);
            $table->double('lhp2dk_realisasi_rupiah', 25, 5);
            $table->double('stp_terbit_target', 25, 5);
            $table->double('stp_terbit_jumlah', 25, 5);
            $table->double('stp_terbit_rupiah', 25, 5);
            $table->foreignId('pegawai_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mingguans');
    }
}
