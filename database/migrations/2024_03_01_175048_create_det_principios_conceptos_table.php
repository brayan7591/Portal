<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetPrincipiosConceptosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('det_principios_conceptos', function (Blueprint $table) {
            $table->id();
            $table->string('detalle');
            $table->unsignedBigInteger('principios_concepto_id');
            $table->foreign('principios_concepto_id')->references('id')->on('principios_conceptos')->onDelete('cascade');
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
        Schema::dropIfExists('det_principios_conceptos');
    }
}
