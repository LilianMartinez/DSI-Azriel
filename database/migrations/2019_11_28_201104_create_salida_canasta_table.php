<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidaCanastaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida_canasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha');
            $table->bigInteger('id_existenciaC')->unsigned();
            $table->foreign('id_existenciaC')->references('id')->on('existencia_canasta');
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
        Schema::dropIfExists('salida_canasta');
    }
}
