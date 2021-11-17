<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolioFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folio_facturas', function (Blueprint $table) {
            $table->id('id_folio');
            $table->double('inicio');
            $table->double('final');
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->double('contador');
            $table->integer('tipo');
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_estado')->references('id')->on('estados');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('folio_facturas');
    }
}
