<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActividadesProtocolosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades_protocolos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_actividad');
            $table->integer('id_protocolo');

            $table->foreign('id_actividad')->references('id')->on('actividades');
            $table->foreign('id_protocolo')->references('id')->on('protocolos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividades_protocolos');
    }
}
