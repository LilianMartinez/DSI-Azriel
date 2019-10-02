<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartidaNacimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas_nacimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alcaldia',60);
            $table->integer('libro');
            $table->integer('partida');
            $table->integer('folio');
            $table->integer('ano');
            $table->biginteger('idpersona')->unsigned();
            $table->foreign('idpersona')->references('id')->on('personas');
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
        Schema::dropIfExists('partida_nacimiento');
    }
}
