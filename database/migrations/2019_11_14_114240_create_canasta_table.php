<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanastaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canasta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_canasta',50);
            $table->float('costo_canasta',10,2);
            $table->float('precio_venta',10,2);
            $table->date('fecha');
            $table->integer('cantidad');
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
        Schema::dropIfExists('canasta');
    }
}
