<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaCreditosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_creditos', function (Blueprint $table) {
            $table->id('id_facturaCredito');
            $table->unsignedBigInteger('id_factura');
            $table->double('saldo');
            $table->unsignedBigInteger('id_estado');

            $table->foreign('id_factura')->references('id_factura')->on('facturas')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estado_cuentas');
         
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_creditos');
    }
}
