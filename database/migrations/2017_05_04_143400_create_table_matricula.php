<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMatricula extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matricula', function (Blueprint $table) {
            $table->increments('mat_id');
            $table->string('alumno_rut', 12);
            $table->integer('est_anterior_id')->unsigned()->nullable();
            $table->integer('periodo_id')->unsigned();
            $table->integer('mat_numero')->unsigned()->nullable();
            $table->float('mat_prom_general')->nullable();
            $table->boolean('mat_grado_curso');
            $table->boolean('mat_tipo_alumno');
            $table->boolean('mat_estado');
            $table->string('mat_proc_escolar', 50);
            $table->date('mat_fecha_ingreso');
            $table->date('mat_fecha_retiro')->nullable();
            $table->text('mat_motivo')->nullable();
            $table->text('mat_observacion')->nullable();
            $table->float('mat_prom_ingreso');
            $table->integer('mat_posicion_lista')->nullable();
            $table->boolean('mat_condicional')->nullable();
            $table->text('mat_causas_cond')->nullable();
            $table->boolean('mat_clases_religion')->nullable();
            $table->string('mat_apod_retira', 12)->nullable();
            $table->boolean('mat_sit_padres');
            $table->string('mat_convive', 20);
            $table->integer('mat_cant_hermanos');


            $table->timestamps();
            $table->foreign('alumno_rut')->references('al_rut')->on('alumno')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('est_anterior_id')->references('eant_id')->on('establecimiento_anterior')->onDelete('cascade');
            $table->foreign('periodo_id')->references('pac_id')->on('periodo_academico')->onDelete('cascade');
        });
        Schema::create('alumno_tiene', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula_id')->unsigned();
            $table->string('padres_rut', 12);

            $table->foreign('padres_rut')->references('pad_rut')->on('padres')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');

            $table->timestamps();

        });

        Schema::create('apoderado_representa', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('matricula_id')->unsigned();
            $table->integer('apoderado_id')->unsigned();

            $table->foreign('apoderado_id')->references('ap_id')->on('apoderado')->onDelete('cascade');
            $table->foreign('matricula_id')->references('mat_id')->on('matricula')->onDelete('cascade');

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
        Schema::dropIfExists('matricula');
    }
}
