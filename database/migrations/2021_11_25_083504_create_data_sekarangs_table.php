<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSekarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_sekarangs', function (Blueprint $table) {
            $table->id();
            $table->string('peringkat_kpp_kanwil');
            $table->string('peringkat_kpp_nonpratama');
            $table->string('peringkat_kpp_nasional');
            $table->string('peringkat_pajak_1');
            $table->string('peringkat_pajak_2');
            $table->string('peringkat_pajak_3');
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
        Schema::dropIfExists('data_sekarangs');
    }
}
