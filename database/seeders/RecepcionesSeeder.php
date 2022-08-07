<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecepcionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recepciones')->insert([
            'id' => 1,
            'proveedor_id' => 1,
            'documento' => '25',
            'tipo_documentos_id' => 33,
            'total_neto' => 100,
            'total_iva' => 19,
            'unidades' => 2,
            'observaciones' => 'Recepcion de prueba',
            'fecha_recepcion' => '2022-05-27',
            'user_id' => 1,
        ]);
    }
}