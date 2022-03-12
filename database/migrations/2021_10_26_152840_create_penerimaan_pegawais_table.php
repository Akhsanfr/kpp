<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaanPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaan_pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('tahun');
            $table->enum('bulan', [1,2,3,4,5,6,7,8,9,10,11,12]);
            $table->enum('pekan', [1,2,3,4,5]);
            $table->integer('sp2dk_target');
            $table->integer('sp2dk_jumlah');
            $table->integer('lhp2dk_target');
            $table->integer('lhp2dk_jumlah');
            $table->integer('lp2dk_realisasi_rupiah');
            $table->integer('lhpt_target');
            $table->integer('lhpt_jumlah');
            $table->integer('sp2dk_terbit_target');
            $table->integer('sp2dk_terbit_jumlah');
            $table->integer('lhpt_lhp2dk_target');
            $table->integer('lhpt_lhp2dk_jumlah');
            $table->integer('lhp2dk_realisasi_rupiah');
            $table->integer('stp_terbit_target');
            $table->integer('stp_terbit_jumlah');
            $table->integer('stp_terbit_rupiah');
            $table->foreignId('pegawai_id')->constrained();
            $table->timestamps();

            $table->unique(['tahun', 'bulan', 'pekan', 'pegawai_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penerimaan_pegawais');
    }
}
