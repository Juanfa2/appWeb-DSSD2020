<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocolos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->unsignedBigInteger('id_responsable');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->integer('orden');
            $table->boolean('es_local');
            $table->integer('puntaje')->nullable();
            $table->unsignedBigInteger('id_proyecto');
            $table->timestamp('fecha_lanzamiento')->nullable();
            $table->timestamp('fecha_terminacion')->nullable();
            $table->foreign('id_responsable')->references('id')->on('users');
            $table->foreign('id_proyecto')->references('id')->on('proyectos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('protocolos');
    }
}
