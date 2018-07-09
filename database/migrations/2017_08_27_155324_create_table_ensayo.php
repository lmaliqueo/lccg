<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEnsayo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ensayo', function (Blueprint $table) {
            $table->increments('ens_id');
            $table->integer('periodo_id')->unsigned();
            $table->integer('tipo_id')->unsigned();
            $table->integer('materia_id')->unsigned();
            $table->string('ens_grado_curso');
            $table->date('ens_fecha');
            $table->timestamps();

            $table->foreign('periodo_id')->references('pac_id')->on('periodo_academico')->onDelete('cascade');
            $table->foreign('tipo_id')->references('ten_id')->on('tipo_ensayo')->onDelete('cascade');
            $table->foreign('materia_id')->references('mens_id')->on('materia_ensayos')->onDelete('cascade');
        });



        Schema::create('alumno_realiza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('ensayo_id')->unsigned();
            $table->integer('alr_resultado');

            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');
            $table->foreign('ensayo_id')->references('ens_id')->on('ensayo')->onDelete('cascade');

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
        Schema::dropIfExists('ensayo');
    }
}
