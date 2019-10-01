<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaMarginalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas_marginales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nota',100);
            $table->bigInteger('id_sacramento')->unsigned();
            $table->foreign('id_sacramento')->references('id')->on('sacramentos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_marginal');
    }
}
