<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVocerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voceros', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->string('Email')->unique();
            $table->integer('NoFicha')->unique();
            $table->unsignedBigInteger('programa_id');
            $table->foreign('programa_id')->references('id')->on('programas')->onDelete('cascade');
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
        Schema::dropIfExists('voceros');
    }
}
