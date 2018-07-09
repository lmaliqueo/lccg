<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNotas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->increments('not_id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('semestre_id')->unsigned();
            $table->integer('clase_id')->unsigned();
            $table->float('not_nota1')->nullable();
            $table->float('not_nota2')->nullable();
            $table->float('not_nota3')->nullable();
            $table->float('not_nota4')->nullable();
            $table->float('not_nota5')->nullable();
            $table->float('not_nota6')->nullable();
            $table->float('not_nota7')->nullable();
            $table->float('not_nota8')->nullable();
            $table->float('not_nota9')->nullable();
            $table->float('not_nota10')->nullable();
            $table->float('not_nota11')->nullable();
            $table->float('not_nota12')->nullable();
            $table->float('not_promedio')->nullable();


            $table->timestamps();

            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');
            $table->foreign('clase_id')->references('cla_id')->on('clases')->onDelete('cascade');
            $table->foreign('semestre_id')->references('sem_id')->on('semestre')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notas');
    }
}
