<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efectivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_recibo',10) ->nullable();
            $table->string('descripcion_efectivo',50);
            $table->integer('tipo');
            $table->float('monto',10,2);
            $table->date('fecha');
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
        Schema::dropIfExists('efectivos');
    }
}
