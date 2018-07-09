<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePlanEstudio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_estudio', function (Blueprint $table) {
            $table->increments('pest_id');
            $table->integer('pest_numero');
            $table->integer('pest_ano');
            $table->integer('pest_eval_num');
            $table->integer('pest_eval_ano');
            $table->integer('pest_ano_inicio');
            $table->integer('pest_ano_termino')->nullable();
            $table->boolean('pest_estado');
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
        Schema::dropIfExists('plan_estudio');
    }
}
