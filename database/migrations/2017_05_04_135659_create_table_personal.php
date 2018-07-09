<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal', function (Blueprint $table) {
            $table->increments('pers_id');
            $table->string('persona_rut', 12);
            $table->integer('institucion_id')->unsigned()->nullable();
            $table->integer('cargo_id')->unsigned();
            $table->boolean('pers_estado');

            $table->timestamps();
            $table->foreign('persona_rut')->references('pe_rut')->on('persona')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('institucion_id')->references('inst_id')->on('institucion')->onDelete('cascade');
            $table->foreign('cargo_id')->references('ca_id')->on('cargo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal');
    }
}
