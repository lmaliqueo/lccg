<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->increments('fac_id');
            $table->integer('orden_id')->unsigned();
            $table->integer('responsable_id')->unsigned();
            $table->integer('fac_numero');
            $table->date('fac_fecha');
            $table->integer('fac_costo_total');

            $table->foreign('orden_id')->references('oc_id')->on('orden_compra')->onDelete('cascade');

            $table->foreign('responsable_id')->references('pers_id')->on('personal')->onDelete('cascade');


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
        Schema::dropIfExists('factura');
    }
}
