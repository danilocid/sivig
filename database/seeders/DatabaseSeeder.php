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
            UserSeeder::class,
            mediosdepagoSeeder::class,
            RegionSeeder::class,
            ComunaSeeder::class,
            ClienteSeeder::class,
            ProveedorSeeder::class,
            ArticuloSeeder::class,
            TipoMovimientoSeeder::class,
            TipoDocumentoSeeder::class,
            RecepcionesSeeder::class,
        ]);
    }
}