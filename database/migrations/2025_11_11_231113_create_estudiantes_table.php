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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('id_estudiante', 10);
            $table->string('rude');
            $table->string('ci');
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->char('genero', 1);
            $table->char('estado', 1);
            $table->date('fecha_nacimiento');
            $table->string('observacion');
            $table->timestamps();

            $table->primary(['id_estudiante', 'rude', 'ci']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiantes');
    }
};
