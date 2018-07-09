<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticulo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulo', function (Blueprint $table) {
            $table->integer('art_item');
            $table->integer('tipo_id')->unsigned();
            $table->integer('bodega_id')->unsigned();
            $table->string('art_nombre', 50);
            $table->text('art_descripcion');
            $table->integer('art_cantidad_alta')->unsigned();
            $table->integer('art_cantidad_baja')->unsigned();
            $table->integer('art_cantidad_total')->unsigned();

            $table->primary('art_item');

            $table->timestamps();


            $table->foreign('tipo_id')->references('tart_id')->on('tipo_articulo')->onDelete('cascade');
            $table->foreign('bodega_id')->references('bo_id')->on('bodega')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articulo');
    }
}
