<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id('id_caja');
            $table->date('fecha');
            $table->datetime('fechaHora_inicio');
            $table->datetime('fechaHora_cierre')->nullable();
            $table->double('pos')->nullable();
            $table->double('efectivo')->nullable();
            $table->double('total')->nullable();
            $table->double('faltante')->nullable();
            $table->unsignedBigInteger('id_estado');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_estado')->references('id')->on('estados');
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
