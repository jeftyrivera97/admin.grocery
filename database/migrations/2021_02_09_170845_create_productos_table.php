<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('id_producto');
            $table->string('codigo_producto')->unique();
            $table->string('descripcion');
            $table->string('ruta_imagen')->nullable();
            $table->unsignedBigInteger('id_categoria');
            $table->string('marca');
            $table->string('tamaño')->nullable();
            $table->double('stock');
            $table->unsignedBigInteger('id_impuesto');
            $table->double('gravado');
            $table->double('impuesto');
            $table->double('exento');
            $table->double('precio_compra')->nullable();
            $table->double('precio_venta');
            $table->double('valor');
            $table->unsignedBigInteger('id_proveedor');
            $table->unsignedBigInteger('id_estado');
            
            $table->foreign('id_categoria')->references('id')->on('producto_categorias')->onDelete('cascade');
            $table->foreign('id_impuesto')->references('id_impuesto')->on('impuestos')->onDelete('cascade');
            $table->foreign('id_proveedor')->references('id_proveedor')->on('proveedores')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
