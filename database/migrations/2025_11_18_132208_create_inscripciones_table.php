<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inscripciones', function (Blueprint $table) {
            $table->bigIncrements('id_inscripcion');
            $table->string('id_estudiante');
            $table->string('id_curso');
            $table->unsignedBigInteger('id_gestion');

            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            $table->foreign('id_curso')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscripciones');
    }
};
