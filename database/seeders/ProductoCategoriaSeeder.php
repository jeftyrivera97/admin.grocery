<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductoCategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Accesorios de Hombre',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Accesorios de Mujer',
            'id_estado' => '1',
        ]);

        DB::table('producto_categorias')->insert([
            'descripcion' => 'Barro',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Barro Lenca',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Bufandas',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Carteras',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Ceramica',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Chile',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Chocolate',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Cojines',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Cristaleria',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Cuadros Pintados',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Hamacas',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Joyeria',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Llaveros',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Maceteras',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Madera Pintada',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Madera Tallada',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Madera Lisa',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Magnetos',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Manteles',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Petates',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Plumas',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Postales',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Puros',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Ropa de Caballeros',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Ropa de Dama',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Ropa de Niños',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Sabanas',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Sombreros',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Vainilla',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Zapatos',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Metales',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Bebidas Alcoholicas',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Junco',
            'id_estado' => '1',
        ]);
        DB::table('producto_categorias')->insert([
            'descripcion' => 'Gorras',
            'id_estado' => '1',
        ]);

    }
}
