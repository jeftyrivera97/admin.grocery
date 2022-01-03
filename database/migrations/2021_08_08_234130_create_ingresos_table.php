<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->datetime('fechaHora');
            $table->unsignedBigInteger('id_categoria');
            $table->string('descripcion')->nullable();
            $table->double('total');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_categoria')->references('id')->on('ingreso_categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingresos');
    }
}
