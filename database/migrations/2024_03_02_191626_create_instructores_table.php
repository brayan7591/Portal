<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructores', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Email')->unique();
            $table->string('Especialidad');
            $table->integer('Telefono');
            $table->text('Descripcion');
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programas')->onDelete('cascade');
            $table->enum('jornada', ['mañana', 'tarde', 'mixta', 'nocturna']);
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
        Schema::dropIfExists('instructores');
    }
}
