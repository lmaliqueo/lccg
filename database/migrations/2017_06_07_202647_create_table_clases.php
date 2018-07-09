<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases', function (Blueprint $table) {
            $table->increments('cla_id');
            $table->integer('curso_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();
            $table->integer('profesor_id')->unsigned();
            $table->timestamps();

            $table->foreign('curso_id')->references('cu_id')->on('curso');
            $table->foreign('asignatura_id')->references('asig_id')->on('asignatura');
            $table->foreign('profesor_id')->references('pers_id')->on('personal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clases');
    }
}
