<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->id();
            $table->string('NombrePrograma')->unique();
            $table->string('slug')->unique();
            $table->integer('codigoPrograma')->unique();
            $table->date('FechaInicio');
            $table->date('FechaFin')->nullable();
            $table->integer('HorasEtapaLectiva');
            $table->integer('HorasEtapaProductiva');
            $table->string('imagen');
            $table->text('Descripcion');
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
        Schema::dropIfExists('programas');
    }
}
