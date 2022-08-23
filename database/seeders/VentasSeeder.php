<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class VentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        DB::table('ventas')->insert([
            'monto_neto' => 100,
            'monto_imp' => 19,
            'costo_neto' => 100,
            'costo_imp' => 19,
            'tipo_documentos_id' => 39,
            'documento' => '123',
            'cliente_id' => 1,
            'medio_pago_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'user_id' => 1,
            'unidades' => 2,

        ]);
    }
}