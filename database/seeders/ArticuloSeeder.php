<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('articulos')->insert([
            'id' => 1,
            'cod_interno' => 'test',
            'cod_barras' => 'test',
            'descripcion'=> 'articulo de pruebas',
            'costo_neto' => 840,
            'costo_imp' => 160,
            'venta_neto' => 1681,
            'venta_imp' => 319,
            'stock' => 10,
            'stock_critico' => 5,
            'activo' => true,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
