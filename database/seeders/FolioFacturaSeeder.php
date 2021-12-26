<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class FolioFacturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('folio_facturas')->insert([
            'inicio' => 1,
            'final' => 1000000,
            'fecha_inicial' => '2022-01-01',
            'fecha_final' => '2030-01-01',
            'contador' => 1,
            'contador_temp' => 1,
            'restantes' => 1000000,
            'tipo' => 'Credito',
            'id_estado' => 2,
        ]);
    }
}
