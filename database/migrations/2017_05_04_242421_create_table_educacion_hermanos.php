<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEducacionHermanos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educacion_hermanos', function (Blueprint $table) {
            $table->increments('edh_id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('edh_cantidad');
            $table->string('edh_descripcion', 15);


            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');


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
        Schema::dropIfExists('educacion_hermanos');
    }
}
