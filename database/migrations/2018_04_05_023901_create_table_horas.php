<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHoras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas', function (Blueprint $table) {
            $table->increments('hors_id');
            $table->integer('periodo_id')->unsigned();
            $table->integer('hors_numero')->unsigned();
            $table->time('hors_hora_inicio');
            $table->time('hors_hora_termino');
            $table->timestamps();

            $table->foreign('periodo_id')->references('pac_id')->on('periodo_academico')->onDelete('cascade');
        });


        Schema::create('horas_horario', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('horas_id')->unsigned();
            $table->integer('horario_id')->unsigned();

            $table->timestamps();
            $table->foreign('horas_id')->references('hors_id')->on('horas')->onDelete('cascade');
            $table->foreign('horario_id')->references('hor_id')->on('horario')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horas');
    }
}
