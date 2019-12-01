<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('precio_venta',10,2);
            $table->integer('cantidad');
            $table->bigInteger('id_entrada')->unsigned();
            $table->foreign('id_entrada')->references('id')->on('detalle_entrada');
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
        Schema::dropIfExists('existencias');
    }
}
