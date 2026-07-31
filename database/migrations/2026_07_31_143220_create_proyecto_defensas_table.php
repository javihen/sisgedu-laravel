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
        Schema::create('proyecto_defensas', function (Blueprint $table) {
            $table->id('idDefensa');
            $table->unsignedBigInteger('idProyecto');
            $table->date('fecha');
            $table->time('hora');
            $table->string('aula', 100);
            $table->enum('estado', [
                'PROGRAMADA',
                'REALIZADA',
                'SUSPENDIDA',
            ])->default('PROGRAMADA');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->foreign('idProyecto')
                ->references('idProyecto')
                ->on('proyectos_grado')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_defensas');
    }
};
