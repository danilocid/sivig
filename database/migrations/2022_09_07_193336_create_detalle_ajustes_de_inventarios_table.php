<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAjustesDeInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ajustes_de_inventarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ajuste_de_inventario_id')->constrained('ajustes_de_inventarios');
            $table->foreignId('articulo_id')->constrained('articulos');
            $table->integer('costo_neto');
            $table->integer('costo_imp');
            $table->integer('entradas');
            $table->integer('salidas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ajustes_de_inventarios');
    }
}