<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjustesDeInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajustes_de_inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('costo_neto');
            $table->integer('costo_imp');
            $table->integer('entradas');
            $table->integer('salidas');
            $table->foreignId('tipo_movimiento_id')->constrained('tipo_movimientos');
            $table->string('observaciones');
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('ajustes_de_inventarios');
    }
}