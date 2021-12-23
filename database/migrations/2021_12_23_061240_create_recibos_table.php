<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecibosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibos', function (Blueprint $table) {
            $table->id('id_recibo');
            $table->string('codigo_recibo');
            $table->date('fecha');
            $table->datetime('fechaHora');
            $table->unsignedBigInteger('id_cliente');
            $table->unsignedBigInteger('tipo_pago');
            $table->unsignedBigInteger('id_estado');
            $table->double('total');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estado_cuentas');
            $table->foreign('tipo_pago')->references('id')->on('tipo_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibos');
    }
}
