<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescripcionCanastaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descripcion_canasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
            $table->bigInteger('id_existencia')->unsigned();
            $table->foreign('id_existencia')->references('id')->on('existencias');
            $table->bigInteger('id_canasta')->unsigned();
            $table->foreign('id_canasta')->references('id')->on('canasta');
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
        Schema::dropIfExists('descripcion_canasta');
    }
}
