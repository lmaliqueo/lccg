<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso', function (Blueprint $table) {
            $table->increments('cu_id');
            $table->integer('periodo_id')->unsigned();
            $table->integer('aula_id')->unsigned()->nullable();
            $table->integer('parametro_id')->unsigned()->nullable();
            $table->integer('profesor_id')->unsigned()->nullable();
            $table->integer('plan_estudio_id')->unsigned()->nullable();

            $table->boolean('cu_tipo');


            $table->timestamps();
            $table->foreign('periodo_id')->references('pac_id')->on('periodo_academico')->onDelete('cascade');
            $table->foreign('aula_id')->references('aul_id')->on('aulas')->onDelete('cascade');
            $table->foreign('parametro_id')->references('pcur_id')->on('parametro_cursos')->onDelete('cascade');
            $table->foreign('profesor_id')->references('pers_id')->on('personal')->onDelete('cascade');
            $table->foreign('plan_estudio_id')->references('pest_id')->on('plan_estudio')->onDelete('set null');
        });



        Schema::create('alumno_esta', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('curso_id')->unsigned();

            $table->foreign('curso_id')->references('cu_id')->on('curso');
            $table->foreign('matricula_id')->references('mat_id')->on('matricula');

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
        Schema::dropIfExists('curso');
    }
}
