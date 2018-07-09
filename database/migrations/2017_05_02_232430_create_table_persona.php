<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersona extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona', function (Blueprint $table) {
            $table->string('pe_rut', 12);
            $table->string('pe_nombres', 50);
            $table->string('pe_apellido_pat', 30);
            $table->string('pe_apellido_mat', 30);
            $table->integer('pe_contacto')->unsigned()->nullable();

            $table->timestamps();
            $table->primary('pe_rut');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona');
    }
}
