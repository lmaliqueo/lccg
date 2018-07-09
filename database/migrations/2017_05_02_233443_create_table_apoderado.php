<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableApoderado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apoderado', function (Blueprint $table) {
            $table->increments('ap_id');
            $table->string('persona_rut', 12)->notnull();
            $table->boolean('ap_tipo');
            $table->string('ap_parentesco', 20);
            $table->string('ap_direccion', 100);

            $table->timestamps();
            $table->foreign('persona_rut')->references('pe_rut')->on('persona')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apoderado');
    }
}
