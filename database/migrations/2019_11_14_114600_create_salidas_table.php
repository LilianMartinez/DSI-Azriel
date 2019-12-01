<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('precio_ventaF',10,2);
            $table->date('fecha');
            $table->integer('cantidad');
            $table->bigInteger('id_existencia')->unsigned();
            $table->foreign('id_existencia')->references('id')->on('existencias');
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
        Schema::dropIfExists('salidas');
    }
}
