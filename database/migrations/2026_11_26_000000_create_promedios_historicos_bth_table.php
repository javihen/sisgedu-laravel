<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promedios_historicos_bth', function (Blueprint $table) {
            $table->id();
            $table->string('id_estudiante', 10);
            $table->integer('id_materia');
            $table->unsignedSmallInteger('anio');
            $table->decimal('promedio', 5, 2);
            $table->timestamps();

            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('estudiantes')
                ->onDelete('cascade');
            $table->foreign('id_materia')
                ->references('id_materia')
                ->on('materias')
                ->onDelete('cascade');
            $table->unique(['id_estudiante', 'id_materia', 'anio']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promedios_historicos_bth');
    }
};
