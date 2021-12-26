<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            EstadoSeeder::class,
            ImpuestoSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class,
            EmpresaSeeder::class,
            TipoCuentaSeeder::class,
            TipoPagoSeeder::class,
            IngresoCategoriaSeeder::class,
            EgresoCategoriaSeeder::class,
            EstadoCuentaSeeder::class,
            ProductoCategoriaSeeder::class,
            GastoCategoriaSeeder::class,
            CompraCategoriaSeeder::class,
            IngresoEgresoTipoSeeder::class,
            FolioFacturaSeeder::class,
        ]);
    }
}
