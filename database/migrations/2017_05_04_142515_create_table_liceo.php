<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLiceo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liceo', function (Blueprint $table) {
            $table->increments('lic_id');
            $table->string('lic_rol_base_datos', 20);
            $table->date('lic_fecha_resol_rec_ofic');
            $table->integer('lic_numero_resol_rec_ofic');
            $table->string('lic_logo', 1024);
            $table->integer('lic_numero');
            $table->string('lic_letra', 1);
            $table->string('lic_nombre', 100);
            $table->string('lic_direccion', 100);
            $table->string('lic_jornada', 15);
            $table->integer('lic_semestres');


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
        Schema::dropIfExists('liceo');
    }
}
