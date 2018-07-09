<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiaClase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dia_clase', function (Blueprint $table) {
            $table->increments('dc_id');
            $table->integer('semestre_id')->unsigned();
            $table->date('dc_fecha');
            $table->timestamps();



            $table->foreign('semestre_id')->references('sem_id')->on('semestre')->onDelete('cascade');
        });

        Schema::create('alumno_asiste', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dia_clase_id')->unsigned();
            $table->integer('matricula_id')->unsigned();
            $table->boolean('ala_estado');

            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');
            $table->foreign('dia_clase_id')->references('dc_id')->on('dia_clase')->onDelete('cascade');


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
        Schema::dropIfExists('dia_clase');
    }
}
