<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetalleEntradaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_entrada', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('precio_compra',10,2);
            $table->float('unitario',10,2);
            $table->date('fecha');
            $table->integer('cantidad');
            $table->integer('tipo');
            $table->bigInteger('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('producto');
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
        Schema::dropIfExists('detalle_entrada');
    }
}
