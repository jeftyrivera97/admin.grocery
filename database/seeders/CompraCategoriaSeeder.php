<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompraCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Accesorios',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Alfareria',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Alfombras',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Artesania',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Bebidas Alcoholicas',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Comestibles',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Cuadros',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Cristaleria',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Joyeria',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Postales',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Ropa',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Tabacco',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Zapatos',
            'id_estado' => '1',
        ]);
        DB::table('compra_categorias')->insert([
            'descripcion' => 'Varios',
            'id_estado' => '1',
        ]);
    }
}
