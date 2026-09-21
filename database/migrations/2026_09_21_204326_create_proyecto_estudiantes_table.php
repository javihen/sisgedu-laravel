<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_estudiantes', function (Blueprint $table) {

            // Clave primaria
            $table->increments('idproyecto_estudiantes');

            // Relación con proyectos_grado
            $table->unsignedBigInteger('idProyecto');

            // Relación con estudiantes
            $table->string('id_estudiante', 20);

            // Timestamps
            $table->timestamps();

            // Claves foráneas
            $table->foreign('idProyecto')
                ->references('idProyecto')
                ->on('proyectos_grado')
                ->onDelete('cascade');

            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('estudiantes')
                ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_estudiantes');
    }
};
