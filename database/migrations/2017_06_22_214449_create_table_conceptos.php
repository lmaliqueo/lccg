<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_pauta', function (Blueprint $table) {
            $table->increments('gp_id');
            $table->string('gp_descripcion', 100);
            $table->timestamps();
        });


        Schema::create('detalle_pauta', function (Blueprint $table) {
            $table->increments('dp_id');
            $table->integer('grupopauta_id')->unsigned();
            $table->string('dp_descripcion', 100);
            $table->timestamps();


            $table->foreign('grupopauta_id')->references('gp_id')->on('grupo_pauta');
        });


        Schema::create('conceptos', function (Blueprint $table) {
            $table->increments('con_id');
            $table->string('con_nombre', 30);
            $table->string('con_descripcion', 150);
            $table->timestamps();
        });

        Schema::create('eva_comportamiento', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('detallepauta_id')->unsigned();
            $table->integer('concepto_id')->unsigned();

            $table->foreign('matricula_id')->references('mat_id')->on('matricula');
            $table->foreign('detallepauta_id')->references('dp_id')->on('detalle_pauta');
            $table->foreign('concepto_id')->references('con_id')->on('conceptos');

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
        Schema::dropIfExists('grupo_pauta');
    }
}
