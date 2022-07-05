<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetalleRecepcionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detalle_recepcions')->insert([
            'recepcion_id' => 1,
            'producto_id' => 1,
            'cantidad' => 1,
            'precio_unitario' => 100,
            'impuesto_unitario' => 19,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
    }
}