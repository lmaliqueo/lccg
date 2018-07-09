<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePeriodoAcademico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodo_academico', function (Blueprint $table) {
            $table->increments('pac_id');
            $table->integer('liceo_id')->unsigned();

            $table->integer('pac_ano');
            $table->date('pac_fecha_inicio');
            $table->date('pac_fecha_termino');
            $table->boolean('pac_estado');

            $table->timestamps();



            $table->foreign('liceo_id')->references('lic_id')->on('liceo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('periodo_academico');
    }
}
