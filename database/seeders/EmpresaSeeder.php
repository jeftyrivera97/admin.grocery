<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresas')->insert([
            'codigo_empresa' => '01011967008088',
            'descripcion' => "Buen Amigo's Souvenir's",
            'direccion' => 'Bo. El Iman, 12 Calle, frente Restaurante 0101, La Ceiba, Atlantida',
            'telefono' => '(504) 2440-1075/ Cel: 3380-0891',
            'razon_social' => 'Mayra Regina Hernandez Moreno',
            'cai' => '9FB2B5-15C31D-3947BD-6A6151-3191A2-97',
            'correo' => 'souvenirbuenamigo@yahoo.com',
            'id_estado' => '1',
        ]);
    }
}
