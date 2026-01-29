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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id('idAsistencia');

            $table->date('fecha');
            $table->time('hora');
            $table->string('descripcion', 100)->nullable();

            $table->unsignedBigInteger('idProfesor');
            $table->Integer('idMateria');
            $table->string('idCurso', 20);
            $table->unsignedBigInteger('id_gestion');

            $table->timestamps();

            // Foreign keys
            $table->foreign('idProfesor')->references('id_profesor')->on('profesores');
            $table->foreign('idMateria')->references('id_materia')->on('materias');
            $table->foreign('idCurso')->references('id')->on('cursos');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestiones');

            // Evita doble registro
            $table->unique(['fecha', 'idProfesor', 'idMateria', 'idCurso', 'id_gestion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
