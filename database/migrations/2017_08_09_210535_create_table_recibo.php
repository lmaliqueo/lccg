<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRecibo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recibo', function (Blueprint $table) {
            $table->increments('rec_id');
            $table->integer('linea_id')->unsigned();
            $table->integer('factura_id')->unsigned();
            $table->integer('rec_cantidad');
            $table->integer('rec_costo');

            $table->foreign('linea_id')->references('lart_id')->on('linea_articulo')->onDelete('cascade');
            $table->foreign('factura_id')->references('fac_id')->on('factura')->onDelete('cascade');

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
        Schema::dropIfExists('recibo');
    }
}
