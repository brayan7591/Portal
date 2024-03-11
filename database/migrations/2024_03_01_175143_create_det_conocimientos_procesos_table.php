<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetConocimientosProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_conocimientos_procesos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conocimientos_proceso_id');
            $table->foreign('conocimientos_proceso_id')->references('id')->on('conocimientos_procesos')->onDelete('cascade');
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
        Schema::dropIfExists('det_conocimientos_procesos');
    }
}
