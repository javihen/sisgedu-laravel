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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->decimal('calificacion', 5, 2);
            $table->integer('periodo');
            $table->string('id_estudiante');
            $table->unsignedBigInteger('idAsignacion');
            $table->unsignedBigInteger('id_gestion');

            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            $table->foreign('idAsignacion')->references('idAsignacion')->on('asignaciones')->onDelete('cascade');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
