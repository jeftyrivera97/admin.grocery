<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class IngresoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Prestacion de Servicios',
            'id_estado' => 1,
        ]);

        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Venta de Productos',
            'id_estado' => 1,
        ]);

        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Prestamo',
            'id_estado' => 1,
        ]);

        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Venta de Bienes',
            'id_estado' => 1,
        ]);

        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Inyeccion Capital',
            'id_estado' => 1,
        ]);
    }
}
