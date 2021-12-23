<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TipoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_pagos')->insert([
            'descripcion' => 'Efectivo',
        ]);
        DB::table('tipo_pagos')->insert([
            'descripcion' => 'POS',
        ]);
        DB::table('tipo_pagos')->insert([
            'descripcion' => 'Credito',
        ]);
    }
}
