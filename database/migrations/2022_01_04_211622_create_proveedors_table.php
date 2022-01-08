<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProveedorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
               Schema::create('proveedors', function (Blueprint $table) {
            $table->id();
            $table->string('rut')->unique();
            $table->string('razon_social');
            $table->string('nombre_fantasia');
            $table->string('giro');
            $table->string('direccion');
            $table->foreignId('comuna_id')->constrained();
            $table->foreignId('region_id')->constrained();
            $table->string('mail');
            $table->integer('telefono');
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
        Schema::dropIfExists('proveedors');
    }
}
