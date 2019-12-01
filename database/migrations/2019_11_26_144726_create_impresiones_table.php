<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImpresionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresiones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->Integer('idsacra');
            $table->Integer('idperso');
            $table->string('cargoim');
            $table->string('conceptoim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('impresiones');
    }
}
