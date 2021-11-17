<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id('id_factura');
            $table->string('codigo_factura');
            $table->unsignedBigInteger('id_folio');
            $table->date('fecha');
            $table->datetime('fechaHora');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('tipo_pago');
            $table->unsignedBigInteger('tipo_cuenta');
            $table->unsignedBigInteger('id_estado');
            $table->double('descuentos');
            $table->double('exento');
            $table->double('gravado15');
            $table->double('gravado18');
            $table->double('impuesto15');
            $table->double('impuesto18');
            $table->double('total');
            $table->string('total_letras')->nullable();
            $table->double('tipo');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estado_cuentas');
            $table->foreign('tipo_pago')->references('id')->on('tipo_pagos');
            $table->foreign('id_folio')->references('id_folio')->on('folio_facturas');
            $table->foreign('tipo_cuenta')->references('id')->on('tipo_cuentas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
