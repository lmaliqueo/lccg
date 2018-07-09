<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAsistencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->increments('asis_id');
            $table->integer('cla_realizados_id')->unsigned();
            $table->integer('matricula_id')->unsigned();
            $table->boolean('asis_estado');
            $table->timestamps();

            $table->foreign('cla_realizados_id')->references('cr_id')->on('clases_realizadas')->onDelete('cascade');
            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('asistencia');
    }
}
