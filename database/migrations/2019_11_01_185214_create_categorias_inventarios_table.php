<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_inventarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_categoriainv',100);
            $table->string('descripcion_categoriainv',100)->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('articulos');
    }
}
