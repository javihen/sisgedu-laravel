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
        Schema::create('proyecto_grado_asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->unsignedBigInteger('id_sesion');

            /*
            |----------------------------------------------------------
            | Relación con proyecto_estudiantes
            |----------------------------------------------------------
            */
            $table->string('id_estudiante', 20);

            $table->enum('estado_asistencia', [
                'Presente',
                'Retraso',
                'Falta Justificada',
                'Falta Injustificada'
            ])->default('Presente');
            $table->time('hora_llegada')->nullable();
            $table->text('entregable')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('entregable_presentado')->default(false);
            $table->boolean('validado')->default(false);
            $table->timestamps();

            /*
            |----------------------------------------------------------
            | Evita registrar dos veces al mismo estudiante
            | en una misma sesión
            |----------------------------------------------------------
            */
            $table->unique([
                'id_sesion',
                'id_estudiante'
            ]);

            $table->foreign('id_sesion')
                ->references('id_sesion')
                ->on('proyecto_grado_sesiones')
                ->onDelete('cascade');

            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('estudiantes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_grado_asistencias');
    }
};
