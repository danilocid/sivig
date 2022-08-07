<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleMovimientosArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_movimientos_articulos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movimiento_id')->constrained($tables = 'tipo_movimientos');
            $table->integer('id_movimiento');
            $table->foreignId('producto_id')->constrained($tables = 'articulos');
            $table->integer('cantidad');
            $table->foreignId('usuario_id')->constrained($tables = 'users');
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
        Schema::dropIfExists('detalle_movimientos_articulos');
    }
}