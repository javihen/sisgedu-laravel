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
        Schema::create('proyecto_seguimientos', function (Blueprint $table) {
            $table->id('idSeguimiento');
            $table->unsignedBigInteger('idProyecto');
            $table->date('fecha');
            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->integer('porcentaje')->default(0);
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
        Schema::dropIfExists('proyecto_seguimientos');
    }
};
