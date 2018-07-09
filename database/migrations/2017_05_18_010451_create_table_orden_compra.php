<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrdenCompra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_compra', function (Blueprint $table) {
            $table->increments('oc_id');
            $table->integer('proveedor_id')->unsigned();
            $table->integer('oc_numero');
            $table->date('oc_fecha');
            $table->integer('oc_costo')->unsigned();
            $table->boolean('oc_estado');



            $table->timestamps();
            $table->foreign('proveedor_id')->references('prov_id')->on('proveedor')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orden_compra');
    }
}
