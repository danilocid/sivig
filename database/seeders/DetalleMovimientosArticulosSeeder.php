<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DetalleMovimientosArticulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_movimientos_articulos')->insert([
            'movimiento_id' => 1,
            'id_movimiento' => 1,
            'producto_id' => 1,
            'cantidad' => 2,
            'usuario_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('detalle_movimientos_articulos')->insert([
            'movimiento_id' => 2,
            'id_movimiento' => 1,
            'producto_id' => 1,
            'cantidad' => -1,
            'usuario_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}