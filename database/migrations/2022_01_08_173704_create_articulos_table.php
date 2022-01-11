<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->id();
            $table->string('cod_interno')->unique();
            $table->string('cod_barras')->unique();
            $table->string('descripcion');
            $table->integer('costo_neto');
            $table->integer('costo_imp');
            $table->integer('venta_neto');
            $table->integer( 'venta_imp');
            $table->integer('stock');
            $table->integer('stock_critico');
            $table->boolean('activo');
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
        Schema::dropIfExists('articulos');
    }
}
