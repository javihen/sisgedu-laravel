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
        Schema::create('curso_materia', function (Blueprint $table) {
            $table->id('idCursoMateria');
            $table->string('idCurso', 20); // El ID de curso es string en tu proyecto (ej: 'C01A')
            $table->integer('idMateria');
            $table->unsignedBigInteger('idGestion');
            $table->integer('horas_mes')->nullable();
            $table->timestamps();

            // 1. En CursoController, el PK es 'id' y la tabla es 'cursos'
            $table->foreign('idCurso')->references('id')->on('cursos')->onDelete('cascade');

            // 2. En AsignacionController, el PK de materias es 'id_materia' y la tabla es 'materias'
            $table->foreign('idMateria')->references('id_materia')->on('materias')->onDelete('cascade');

            // 3. En GestionController, el PK es 'id_gestion' y la tabla suele ser 'gestiones'
            // (siguiendo el patrón de 'usuarios' y 'materias' que usas)
            $table->foreign('idGestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curso_materia');
    }
};
