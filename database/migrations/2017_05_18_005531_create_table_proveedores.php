<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProveedores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedor', function (Blueprint $table) {
            $table->increments('prov_id');
            $table->integer('comuna_id')->unsigned();
            $table->string('prov_razon_social', 30);
            $table->string('prov_direccion', 100);
            $table->integer('prov_contacto')->unsigned();
            $table->timestamps();

            $table->foreign('comuna_id')->references('com_id')->on('comuna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proveedor');
    }
}
