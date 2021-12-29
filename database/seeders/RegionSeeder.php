<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('regions')->delete();

        $json = '[{
                "id": "1",
                "region": "Arica y Parinacota"
            }, {
                "id": "2",
                "region": "Tarapaca"
            }, {
                "id": "3",
                "region": "Antofagasta"
            }, {
                "id": "4",
                "region": "Atacama"
            }, {
                "id": "5",
                "region": "Coquimbo"
            }, {
                "id": "6",
                "region": "Valparaiso"
            }, {
                "id": "7",
                "region": "Metropolitana de Santiago"
            }, {
                "id": "8",
                "region": "Libertador General Bernardo OHiggins"
            }, {
                "id": "9",
                "region": "Maule"
            }, {
                "id": "10",
                "region": "Ñuble"
            }, {
                "id": "11",
                "region": "Biobio"
            }, {
                "id": "12",
                "region": "La Araucania"
            }, {
                "id": "13",
                "region": "Los Rios"
            }, {
                "id": "14",
                "region": "Los Lagos"
            }, {
                "id": "15",
                "region": "Aysen del General Carlos Ibañez del Campo"
            }, {
                "id": "16",
                "region": "Magallanes y de la Antartica Chilena"
            }]';


        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('regions')->insert([
                'id' => $obj->id,
                'region' => $obj->region,
            ]);
        };
    }
}
