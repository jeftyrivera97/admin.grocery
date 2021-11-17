<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GastoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Planilla',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Alimentacion',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Agua Purificada',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Comida Varios',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Carga',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Cervezas',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Envios y Encomiendas',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Farmacia',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Hospital',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Car Wash',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Veterinaria',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Remesas',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Envio de Dinero',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Compra de Accesorios',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Reparaciones a Terceros',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Refrescos',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Donaciones',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Combustible',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Gastos Administrativos',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Gastos de Taller',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Servicio de Agua Potable',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Energia Electrica',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Internet',
            'id_estado' => 1,
        ]);

        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Impuestos',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Prestamo',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Servicios Funebres',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Sistema',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Terreno',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Renta',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Tarjeta',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Telefono',
            'id_estado' => 1,
        ]);

        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Reparaciones y Construccion',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Suministros',
            'id_estado' => 1,
        ]);

        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Transporte',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Pago de Seguros y Polizas',
            'id_estado' => 1,
        ]);
        DB::table('gasto_categorias')->insert([
            'descripcion' => 'Otro',
            'id_estado' => 1,
        ]);
    }
}
