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
        Schema::create('asignaciones', function (Blueprint $table) {
            $table->bigIncrements('idAsignacion');

            // 1️⃣ Coincide con materias.id_materia (integer primary)
            $table->integer('id_materia');

            // 2️⃣ Coincide con cursos.id (string primary)
            $table->string('idcurso');

            // 3️⃣ Coincide con profesores.id_profesor (bigIncrements = unsignedBigInteger)
            $table->unsignedBigInteger('id_profesor');

            $table->unsignedBigInteger('id_gestion');

            // 🔗 LLAVES FORÁNEAS
            $table->foreign('id_gestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');
            $table->foreign('id_materia')
                  ->references('id_materia')
                  ->on('materias')
                  ->onDelete('cascade');

            $table->foreign('idcurso')
                  ->references('id')
                  ->on('cursos')
                  ->onDelete('cascade');

            $table->foreign('id_profesor')
                  ->references('id_profesor')
                  ->on('profesores')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asignaciones');
    }
};
