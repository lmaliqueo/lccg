<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePadres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('padres', function (Blueprint $table) {

            $table->string('pad_rut', 12)->primary();
            $table->string('pad_nombres', 50);
            $table->string('pad_apellido_pat', 30);
            $table->string('pad_apellido_mat', 30);
            $table->date('pad_fecha_nacimiento');
            $table->integer('pad_contacto')->unsigned()->nullable();

            $table->string('pad_parentesco', 10);
            $table->string('pad_domicilio', 100);
            $table->string('pad_nivel_estudio', 30);
            $table->string('pad_sit_laboral', 30);
            $table->string('pad_profesion', 50)->nullable();
            $table->integer('pad_renta')->nullable();

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
        Schema::dropIfExists('padres');
    }
}
