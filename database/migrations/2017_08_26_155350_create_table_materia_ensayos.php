<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMateriaEnsayos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materia_ensayos', function (Blueprint $table) {
            $table->increments('mens_id');
            $table->string('mens_nombre', 30);
            $table->timestamps();
        });

        Schema::create('tipo_ensayos_tienen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('materia_id')->unsigned();
            $table->integer('tipo_ensayo_id')->unsigned();
            $table->boolean('status');

            $table->foreign('materia_id')->references('mens_id')->on('materia_ensayos');
            $table->foreign('tipo_ensayo_id')->references('ten_id')->on('tipo_ensayo');

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
        Schema::dropIfExists('materia_ensayos');
    }
}
