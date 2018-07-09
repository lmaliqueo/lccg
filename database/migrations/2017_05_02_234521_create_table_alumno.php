<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAlumno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumno', function (Blueprint $table) {
            $table->string('al_rut', 12)->primary();
            $table->string('al_nombres', 50);
            $table->string('al_apellido_pat', 30);
            $table->string('al_apellido_mat', 30);

            $table->integer('comuna_id')->unsigned();
            $table->string('al_domicilio', 100);
            $table->string('al_sexo', 10);
            $table->date('al_fecha_nacimiento');
            $table->integer('al_fono')->nullable();
            $table->string('al_proced_escolar', 20);

            $table->timestamps();
            $table->foreign('comuna_id')->references('com_id')->on('comuna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alumno');
    }
}
