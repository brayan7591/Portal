<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelCompetenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nivel_competencia', function (Blueprint $table) {
            $table->string('SlugInterno');
            $table->unsignedBigInteger('programa_id');
            $table->foreign(['programa_id', 'SlugInterno'])->references(['programa_id', 'SlugInterno'])->on('niveles')->onDelete('cascade');
            $table->integer('codigo_competencia');
            $table->foreign('codigo_competencia')->references('codigo')->on('competencias')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('nivel_competencia');
    }
}
