<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id('id_compra');
            $table->string('codigo_compra');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('tipo_cuenta');
            $table->unsignedBigInteger('id_estado');
            $table->date('fecha');
            $table->date('fecha_pago')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->double('gravado15');
            $table->double('gravado18');
            $table->double('impuesto15');
            $table->double('impuesto18');
            $table->double('exento');
            $table->double('total');
            $table->unsignedBigInteger('id_usuario');

            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id')->on('compra_categorias')->onDelete('cascade');
            $table->foreign('id_estado')->references('id')->on('estado_cuentas');
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
        Schema::dropIfExists('compras');
    }
}
