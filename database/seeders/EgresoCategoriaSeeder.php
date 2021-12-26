<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class EgresoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('egreso_categorias')->insert([
            'descripcion' => 'Compras',
            'id_estado' => 1,
        ]);

        DB::table('ingreso_categorias')->insert([
            'descripcion' => 'Gastos',
            'id_estado' => 1,
        ]);


    }
}
