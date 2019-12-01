<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExistenciaCanastaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('existencia_canasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cantidad');
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
        Schema::dropIfExists('existencia_canasta');
    }
}
