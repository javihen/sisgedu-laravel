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
        Schema::create('proyecto_grado_sesiones', function (Blueprint $table) {
            $table->id('id_sesion');
            $table->unsignedBigInteger('idProyecto');
            $table->unsignedBigInteger('idGestion');
            $table->integer('numero_sesion');
            $table->date('fecha_programada');

            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('tipo_sesion', 50)->default('Ordinaria');
            $table->string('tema')->nullable();
            $table->text('observaciones')->nullable();
            $table->enum('estado', [
                'Programada',
                'En proceso',
                'Finalizada',
                'Cancelada'
            ])->default('Programada');

            $table->timestamps();

            $table->index(['idGestion', 'fecha_programada']);

            // Claves foráneas
            $table->foreign('idProyecto')
                ->references('idProyecto')
                ->on('proyectos_grado')
                ->onDelete('cascade');
             $table->foreign('idGestion')
                ->references('id_gestion')
                ->on('gestiones')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_grado_sesions');
    }
};
