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
        Schema::create('detalle_asistencias', function (Blueprint $table) {
            $table->id('idDetalle');

            $table->unsignedBigInteger('idAsistencia');
            $table->string('idEstudiante', 20);

            $table->string('estado', 20); // Presente, Falta, Retraso
            $table->string('observacion', 100)->nullable();

            $table->timestamps();

            $table->foreign('idAsistencia')
                ->references('idAsistencia')->on('asistencias')
                ->onDelete('cascade');

            $table->foreign('idEstudiante')
                ->references('id_estudiante')->on('estudiantes');

            // Evita doble registro del mismo estudiante
            $table->unique(['idAsistencia', 'idEstudiante']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_asistencias');
    }
};
