<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harians', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->double('ppn_impor', 25, 5);
            $table->double('pph_25_9', 25, 5);
            $table->double('pph_22_impor', 25, 5);
            $table->double('pph_21', 25, 5);
            $table->double('pph_ppndn', 25, 5);
            $table->double('pph_23', 25, 5);
            $table->double('pph_22', 25, 5);
            $table->double('netto', 25, 5);
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
        Schema::dropIfExists('harians');
    }
}
