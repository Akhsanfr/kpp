<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lifetimes', function (Blueprint $table) {
            $table->id();
            $table->string('peringkat_kpp_kanwil');
            $table->string('peringkat_kpp_non_pratama');
            $table->string('peringkat_kpp_nasional');
            $table->string('sektor_pajak_bruto_terbesar_1');
            $table->string('sektor_pajak_bruto_terbesar_2');
            $table->string('sektor_pajak_bruto_terbesar_3');
            $table->string('sektor_wp_tertinggi_1');
            $table->string('sektor_wp_tertinggi_2');
            $table->string('sektor_wp_tertinggi_3');
            $table->string('sektor_wp_tertinggi_4');
            $table->string('sektor_wp_tertinggi_5');
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
        Schema::dropIfExists('lifetimes');
    }
}
