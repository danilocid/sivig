<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_movimientos')->insert([
            'id' => 1,
            'tipo_movimiento' => 'Recepcion',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_movimientos')->insert([
            'id' => 2,
            'tipo_movimiento' => 'Venta',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_movimientos')->insert([
            'id' => 3,
            'tipo_movimiento' => 'Robo',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_movimientos')->insert([
            'id' => 4,
            'tipo_movimiento' => 'Ajuste de inventario',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_movimientos')->insert([
            'id' => 5,
            'tipo_movimiento' => 'Merma',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_movimientos')->insert([
            'id' => 6,
            'tipo_movimiento' => 'Devolucion',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

    }
}
