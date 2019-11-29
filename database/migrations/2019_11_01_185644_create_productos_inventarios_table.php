<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_inventarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->integer('idcategoriainv')->unsigned();
            $table->foreign('idcategoriainv')->references('id')->on('categorias_inventarios');

            $table->string('nombre_producto',100);
            $table->string('marca',100)->nullable();
            $table->string('descripcion',100)->nullable();
            $table->date('fecha_adquirido')->nullable();
            $table->integer('cantidad');
            $table->float('costocompra',10,2)->nullable();
            $table->integer('enuso')->nullable();
            $table->integer('guardadas')->nullable();
            $table->integer('desuso')->nullable();
            $table->integer('estado')->nullable();
            
            $table->integer('idiglesia')->unsigned();
            $table->foreign('idiglesia')->references('id')->on('iglesias');

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
        Schema::dropIfExists('inventario_iglesias');
    }
}
