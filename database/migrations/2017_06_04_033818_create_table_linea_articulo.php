<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLineaArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_articulo', function (Blueprint $table) {
            $table->increments('lart_id');
            $table->integer('ordencompra_id')->unsigned();
            $table->integer('articulo_item');
            $table->integer('lart_cantidad')->unsigned();
            $table->integer('lart_costo')->unsigned();
            $table->timestamps();


            $table->foreign('ordencompra_id')->references('oc_id')->on('orden_compra')->onDelete('cascade');
            $table->foreign('articulo_item')->references('art_item')->on('articulo')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linea_articulo');
    }
}
