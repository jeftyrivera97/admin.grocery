<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@elbuenamigosouvenir.site',
            'password' => bcrypt('Adminsouvenir2021'),
        ]);
        DB::table('users')->insert([
            'name' => 'Romell Romero',
            'email' => 'cajero1@elbuenamigosouvenir.site',
            'password' => bcrypt('Romell2021souvenir'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mayra Hernandez',
            'email' => 'cajero2@elbuenamigosouvenir.site',
            'password' => bcrypt('Mayra2021souvenir'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sistema',
            'email' => 'sistema@elbuenamigosouvenir.site',
            'password' => bcrypt('Pontiac2016'),
        ]);
    }
}
