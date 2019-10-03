<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSacramentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sacramentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tipo_sacramento');
            $table->integer('libro')->nullable();
            $table->integer('folio')->nullable();
            $table->integer('asiento')->nullable();
            $table->integer('num_expediente')->nullable();
            $table->date('fecha_realizacion')->nullable();
            $table->Integer('id_realizante1')->nullable();
            $table->Integer('id_realizante2')->nullable();
            $table->Integer('id_sacerdote')->nullable();
            $table->string('titulo',20)->nullable();
            $table->Integer('id_padrino')->nullable();
            $table->Integer('id_padrino2')->nullable();
            $table->Integer('id_padrino3')->nullable();
            $table->Integer('id_padrino4')->nullable();
            $table->Integer('id_iglesia')->nullable();

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
        Schema::dropIfExists('sacramentos');
    }
}
