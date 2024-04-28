<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaberesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saberes', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->enum('saber', ['conocimiento', 'proceso']);
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
        Schema::dropIfExists('saberes');
    }
}
