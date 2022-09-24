<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AjustesDeInventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ajustes_de_inventarios')->insert([
            'id' => 1,
            'costo_neto' => 840,
            'costo_imp' => 160,
            'entradas' => 1,
            'salidas' => 0,
            'observaciones' => 'ajuste de prueba',
            'user_id' => 1,
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}