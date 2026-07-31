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
        Schema::create('proyectos_grado', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->string('idEstudiante', 20);
            $table->unsignedBigInteger('idProfesorTutor');
            $table->string('idCurso', 255);
            $table->unsignedBigInteger('idGestion');
            $table->string('titulo', 300);
            $table->string('lineaInvestigacion', 150)->nullable();
            $table->text('descripcion')->nullable();
            $table->enum('estado', [
                'REGISTRADO',
                'EN PROCESO',
                'REVISION',
                'APROBADO',
                'DEFENDIDO',
                'REPROBADO',
            ])->default('REGISTRADO');
            $table->date('fechaInicio')->nullable();
            $table->date('fechaDefensa')->nullable();
            $table->decimal('notaFinal', 5, 2)->default(0);
            $table->text('observacion')->nullable();
            $table->timestamps();
            // -----------------------------------
            // Relaciones
            // -----------------------------------
            $table->foreign('idEstudiante')
                ->references('id_estudiante')
                ->on('estudiantes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('idProfesorTutor')
                ->references('id_profesor')
                ->on('profesores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('idCurso')
                ->references('id')
                ->on('cursos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreign('idGestion')
                ->references('id_gestion')
                ->on('gestiones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // -----------------------------------
            // Restricciones
            // -----------------------------------
            $table->unique('idEstudiante');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos_grado');
    }
};
