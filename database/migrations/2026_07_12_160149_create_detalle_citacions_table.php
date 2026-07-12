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
        Schema::create('detalle_citaciones', function (Blueprint $table) {
            $table->bigIncrements('idDetalleCitacion');
            $table->string('estado');
            $table->string('observacion');
            $table->string('id_estudiante');
            $table->foreignid('idCitacionV2');
            $table->timestamps();

            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiantes')->onDelete('cascade');
            $table->foreign('idCitacionV2')->references('idCitacionV2')->on('citacion_v2_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_citacions');
    }
};
