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
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->bigIncrements('idEntrevista');
            $table->string('idEstudiante', 10);
            $table->unsignedBigInteger('idProfesor');
            $table->date('fecha');
            $table->time('hora');
            $table->text('observaciones')->nullable();
            $table->text('acuerdos')->nullable();
            $table->boolean('asistio')->default(false);
            $table->timestamps();

            // Relaciones foráneas
            $table->foreign('idEstudiante')
                ->references('id_estudiante')
                ->on('estudiantes')
                ->onDelete('cascade');

            $table->foreign('idProfesor')
                ->references('id_profesor')
                ->on('profesores')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
