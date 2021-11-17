<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->id('id_transaccion');
            $table->datetime('fecha');
            $table->unsignedBigInteger('id_cliente');
            $table->string('tipo_transaccion');
            $table->double('total');
            $table->double('saldo');
            $table->string('descripcion');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
