<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableClasesRealizadas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clases_realizadas', function (Blueprint $table) {
            $table->increments('cr_id');
            $table->integer('clase_id')->unsigned();
            $table->integer('dia_clase_id')->unsigned();
            $table->boolean('cr_estado');
            $table->text('cr_observacion')->nullable();
            $table->timestamps();


            $table->foreign('clase_id')->references('cla_id')->on('clases')->onDelete('cascade');
            $table->foreign('dia_clase_id')->references('dc_id')->on('dia_clase')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clases_realizadas');
    }
}
