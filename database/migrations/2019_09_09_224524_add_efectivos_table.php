<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('efectivos', function (Blueprint $table) {
            $table->integer('idcare')->nullable();
                });

      /*  DB::table('efectivos')->insert(array('id'=>'20','num_recibo'=>'','descripcion_efectivo'=>'Playeras','tipo'=>'2','monto'=>'90','fecha'=>'2019/09/09','idCaRe'=>'1'));*/
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
