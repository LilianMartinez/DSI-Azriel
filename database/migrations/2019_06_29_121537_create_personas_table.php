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
            $table->bigIncrements('id');
            $table->string('nombre_persona',100);
            $table->string('apellido_persona',100);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('dui_pasaporte',9)->nullable();
            $table->string('sexo',1)->nullable();
            $table->Integer('id_padre')->nullable();
            $table->Integer('id_madre')->nullable();
            $table->Integer('tipo_persona')->nullable();
            $table->integer('estado')->nullable();
            $table->timestamps();
        });

        DB::table('personas')->insert(array('id'=>'1','nombre_persona'=>'DELFINA EUGENIA','apellido_persona'=>'DE AMAS'));
        DB::table('personas')->insert(array('id'=>'2','nombre_persona'=>'PÍO AGUSTIN','apellido_persona'=>'GONZÁLES RIVERA','estado'=>'1','tipo_persona'=>'1'));
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
