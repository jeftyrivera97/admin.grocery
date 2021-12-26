<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class IngresoEgresoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Activo Circulante',
            'id_estado' => 1,
        ]); 

        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Activo Fijo',
            'id_estado' => 1,
        ]); 

        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Activo Diferido',
            'id_estado' => 1,
        ]); 

        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Pasivo Circulante',
            'id_estado' => 1,
        ]); 

        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Pasivo Fijo',
            'id_estado' => 1,
        ]); 

        DB::table('ingreso_egreso_tipos')->insert([
            'descripcion' => 'Pasivo Diferido',
            'id_estado' => 1,
        ]); 
    }
}
