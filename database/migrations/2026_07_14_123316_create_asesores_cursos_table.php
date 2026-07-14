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
        Schema::create('asesores_cursos', function (Blueprint $table) {
            $table->bigIncrements('idAsesorCurso');
            $table->string('estado');
            $table->string('observaciones');
            $table->unsignedBigInteger('id_profesor');
            $table->string('id');
            $table->unsignedBigInteger('id_gestion');
            $table->timestamps();

            // relaciones
            $table->foreign('id_profesor')->references('id_profesor')->on('profesores')->onDelete('cascade');
            $table->foreign('id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('id_gestion')->references('id_gestion')->on('gestiones')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asesores_cursos');
    }
};
