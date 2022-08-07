<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DetalleVentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_ventas')->insert([
            'venta_id' => 1,
            'producto_id' => 1,
            'cantidad' => 2,
            'precio_neto' => 100,
            'precio_imp' => 19,
            'costo_neto' => 100,
            'costo_imp' => 19,
            'created_at' => now(),
            'updated_at' => now(),


        ]);
    }
}