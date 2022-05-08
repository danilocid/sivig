<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained();
            $table->string('documento');
            $table->foreignId('tipo_documentos_id')->constrained();
            $table->integer('total_neto');
            $table->integer('total_iva');
            $table->integer('unidades');
            $table->string('observaciones');
            $table->date('fecha_recepcion');
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepciones');
    }
}