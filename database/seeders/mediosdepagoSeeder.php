<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\mediosdepago;
use Illuminate\Support\Facades\DB;


class mediosdepagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mediosdepagos')->insert([
            'id' => 1,
            'medio_de_pago' => 'Efectivo',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
        DB::table('mediosdepagos')->insert(
        [
            'id' => 2,
            'medio_de_pago' => 'Transferencia',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);
    }
}
