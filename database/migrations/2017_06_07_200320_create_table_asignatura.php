<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAsignatura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignatura', function (Blueprint $table) {
            $table->increments('asig_id');
            $table->string('asig_nombre', 50);
            $table->string('asig_nombre_corto', 5);
            $table->boolean('asig_tipo_asignatura')->nullable();
            $table->boolean('asig_tipo');
            $table->timestamps();
        });



        Schema::create('profesor_especializa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profesor_id')->unsigned();
            $table->integer('asignatura_id')->unsigned();

            $table->foreign('profesor_id')->references('pers_id')->on('personal');
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
        Schema::dropIfExists('asignatura');
    }
}
