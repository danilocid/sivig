<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documentos')->insert([
            'id' => 33,
            'tipo_documento' => 'Factura electronica',
            'ultima_emision' => '0',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_documentos')->insert([
            'id' => 34,
            'tipo_documento' => 'Factura exenta electronica',
            'ultima_emision' => '0',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_documentos')->insert([
            'id' => 39,
            'tipo_documento' => 'Boleta electronica',
            'ultima_emision' => '0',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_documentos')->insert([
            'id' => 41,
            'tipo_documento' => 'Boleta exenta electronica',
            'ultima_emision' => '0',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('tipo_documentos')->insert([
            'id' => 99,
            'tipo_documento' => 'Sin documento',
            'ultima_emision' => '0',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
    }
}