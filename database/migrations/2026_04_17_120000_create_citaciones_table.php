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
        Schema::create('citaciones', function (Blueprint $table) {
            $table->bigIncrements('idCitacion');
            $table->string('idEstudiante');
            $table->string('idCurso');
            $table->unsignedBigInteger('idProfesor');
            $table->integer('idMateria');
            $table->unsignedBigInteger('idGestion');
            $table->date('fecha');
            $table->time('hora');
            $table->string('motivo');
            $table->string('periodo')->nullable();
            $table->enum('tipo', ['individual', 'grupal'])->default('individual');
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idEstudiante')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            $table->foreign('idCurso')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('idProfesor')->references('id_profesor')->on('profesores')->onDelete('cascade');
            $table->foreign('idMateria')->references('id_materia')->on('materias')->onDelete('cascade');
            $table->foreign('idGestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citaciones');
    }
};
