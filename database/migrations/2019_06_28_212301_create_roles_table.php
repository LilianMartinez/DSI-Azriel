<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_rol',30);
            $table->string('descripcion',100)->nullable(); 
            $table->boolean('condicion_rol')->default(1);
        });

        DB::table('roles')->insert(array('id'=>'1','nombre_rol'=>'Parroco','descripcion'=>'Sacerdote encargado de la Parroquia San Luis Gonzaga'));
        DB::table('roles')->insert(array('id'=>'2','nombre_rol'=>'Secretaria','descripcion'=>'Secretaria de la Parroquia San Luis Gonzaga'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
