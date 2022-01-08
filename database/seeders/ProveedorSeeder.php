<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proveedors')->insert([
            'id' => 1,
            'rut' => '11111111-1',
            'razon_social' => 'proveedor generico',
            'nombre_fantasia' => 'proveedor generico',
            'giro' => 'N/A',
            'direccion' => 'N/A',
            'comuna_id' => 204,
            'region_id'=> 10,
            'telefono' => '999999999',
            'mail' => 'cidybadilla@gmail.com',
            'created_at' =>  \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
