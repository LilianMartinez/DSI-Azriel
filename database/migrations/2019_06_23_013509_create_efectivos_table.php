<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efectivos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('num_recibo',10) ->nullable();
            $table->string('descripcion_efectivo',50);
            $table->integer('tipo');
            $table->float('monto',10,2);
            $table->date('fecha');
            $table->timestamps();
        });

        DB::table('efectivos')->insert(array('id'=>'1','num_recibo'=>'','descripcion_efectivo'=>'FOTOCOPIAS','tipo'=>'1','monto'=>'3.00','fecha'=>'2019-06-30'));
        DB::table('efectivos')->insert(array('id'=>'2','num_recibo'=>'N°00025','descripcion_efectivo'=>'SILLAS','tipo'=>'2','monto'=>'25.00','fecha'=>'2019-07-04'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('efectivos');
    }
}
