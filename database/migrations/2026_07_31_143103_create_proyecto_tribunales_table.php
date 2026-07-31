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
        Schema::create('proyecto_tribunales', function (Blueprint $table) {
            $table->id('idTribunal');

            $table->unsignedBigInteger('idProyecto');

            $table->unsignedBigInteger('idProfesor');

            $table->enum('cargo', [
                'PRESIDENTE',
                'VOCAL',
                'SECRETARIO',
            ]);

            $table->timestamps();

            $table->foreign('idProyecto')
                ->references('idProyecto')
                ->on('proyectos_grado')
                ->cascadeOnDelete();

            $table->foreign('idProfesor')
                ->references('id_profesor')
                ->on('profesores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_tribunales');
    }
};
