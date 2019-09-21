<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personas', function (Blueprint $table) {
        $table->date('fecha_nacimiento')->nullable();
        $table->string('dui_pasaporte',9)->nullable();
        $table->string('sexo',1)->nullable();
        $table->Integer('id_padre')->nullable();
        $table->Integer('id_madre')->nullable();
        });

      /*  DB::table('personas')->insertGetId(['id'=>'3','nombre_persona'=>'Gloria','apellido_persona'=>'Ganuza','fecha_nacimiento'=>'1996/06/12','dui_pasaporte'=>'111111111','sexo'=>'2','id_padre'=>'1','id_madre'=>'2']);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
