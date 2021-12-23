<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReciboDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo_detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->integer('linea');
            $table->unsignedBigInteger('id_recibo');
            $table->unsignedBigInteger('id_producto');
            $table->double('cantidad');
            $table->double('precio_venta');
            $table->double('subtotal');
           
            $table->foreign('id_recibo')->references('id_recibo')->on('recibos')->onDelete('cascade');
            $table->foreign('id_producto')->references('id_producto')->on('productos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recibo_detalles');
    }
}
