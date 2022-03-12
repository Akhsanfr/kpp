<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerimaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerimaans', function (Blueprint $table) {
            $table->id();

            $table->date('tanggal');
            $table->double('ppn_impor', 20, 5);
            $table->double('pph_25_9', 20, 5);

            $table->double('pph_22_impor', 20, 5);
            $table->double('pph_21', 20, 5);
            $table->double('pph_ppndn', 20, 5);

            $table->double('pph_23', 20, 5);
            $table->double('pph_22', 20, 5);
            $table->float('capaian_netto', 5, 5);

            $table->float('capaian_bruto', 5, 5);
            $table->float('pertumbuhan_netto', 5, 5);
            $table->float('pertumbuhan_bruto', 5, 5);

            $table->double('penerimaan_target', 20, 5);
            $table->double('penerimaan_netto', 20, 5);
            $table->double('penerimaan_spmkp', 20, 5);

            $table->enum('tipe', ['spmkp', 'bruto']);
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
        Schema::dropIfExists('penerimaans');
    }
}
