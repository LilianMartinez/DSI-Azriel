<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_persona',100);
            $table->string('apellido_persona',100);
            $table->timestamps();
        });

        DB::table('personas')->insert(array('id'=>'1','nombre_persona'=>'DELFINA EUGENIA','apellido_persona'=>'DE AMAS'));
        DB::table('personas')->insert(array('id'=>'2','nombre_persona'=>'PÍO AGUSTIN','apellido_persona'=>'GONZÁLES RIVERA'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}