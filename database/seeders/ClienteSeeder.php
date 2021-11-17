<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'nombre' => 'Consumidor Final',
            'codigo_cliente' => '0000-0000-000000',
            'id_estado' => '1',
        ]);
        DB::table('clientes')->insert([
            'nombre' => 'Prueba',
            'codigo_cliente' => '0000-000000-000000',
            'id_estado' => '1',
        ]);
    }
}
