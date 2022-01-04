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
            'email' => 'adm1n@elbuenamigosouvenir.site',
            'password' => bcrypt('@dm1ns0uv3n1r2022'),
        ]);
        DB::table('users')->insert([
            'name' => 'Romell',
            'email' => 'r0m311@elbuenamigosouvenir.site',
            'password' => bcrypt('R0m311s0uv3n1r2022'),
        ]);
        DB::table('users')->insert([
            'name' => 'Mayra',
            'email' => 'ma1ra@elbuenamigosouvenir.site',
            'password' => bcrypt('M@yr@s0uv3n1r2022'),
        ]);
        DB::table('users')->insert([
            'name' => 'Sistema',
            'email' => 's1st3ma@elbuenamigosouvenir.site',
            'password' => bcrypt('Jriver@s1st3m@s2022'),
        ]);
    }
}
