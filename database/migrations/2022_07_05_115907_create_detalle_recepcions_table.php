<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleRecepcionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_recepcions', function (Blueprint $tables) {
            $tables->id();
            $tables->foreignId('recepcion_id')->constrained($table = 'recepciones');
            $tables->foreignId('producto_id')->constrained($table = 'articulos');
            $tables->integer('cantidad');
            $tables->integer('precio_unitario');
            $tables->integer('impuesto_unitario');
            $tables->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_recepcions');
    }
}
