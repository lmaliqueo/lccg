<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableSemestre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semestre', function (Blueprint $table) {
            $table->increments('sem_id');
            $table->integer('periodo_id')->unsigned();
            $table->integer('sem_numero');
            $table->boolean('sem_estado');
            $table->date('sem_fecha_inicio');
            $table->date('sem_fecha_termino');
            $table->timestamps();

            $table->foreign('periodo_id')->references('pac_id')->on('periodo_academico')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semestre');
    }
}
