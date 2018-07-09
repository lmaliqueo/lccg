<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNivelCursos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_cursos', function (Blueprint $table) {
            $table->increments('nic_id');
            $table->integer('nic_nivel');
            $table->timestamps();
        });



        Schema::create('plan_organiza', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plan_id')->unsigned();
            $table->integer('nivel_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();
            $table->integer('porg_cant_horas');


            $table->foreign('plan_id')->references('pest_id')->on('plan_estudio')->onDelete('cascade');
            $table->foreign('nivel_id')->references('nic_id')->on('nivel_cursos')->onDelete('cascade');
            $table->foreign('asignatura_id')->references('asig_id')->on('asignatura');


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
        Schema::dropIfExists('nivel_cursos');
    }
}
