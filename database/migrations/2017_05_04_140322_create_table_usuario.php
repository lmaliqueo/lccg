<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario', function (Blueprint $table) {
            $table->increments('us_id');
            $table->string('persona_rut', 12);
            $table->integer('rol_id')->unsigned();
            $table->string('us_username', 20);
            $table->string('us_email', 50)->unique();
            $table->string('us_password', 255);
            $table->boolean('us_estado');
            $table->string('password', 255);

            $table->rememberToken();


            $table->timestamps();
            $table->foreign('persona_rut')->references('pe_rut')->on('persona')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario');
    }
}
