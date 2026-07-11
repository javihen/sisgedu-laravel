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
        Schema::create('citacion_v2_s', function (Blueprint $table) {
            $table->bigIncrements('idCitacionV2');
            $table->foreignId('idAsignacion');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado');
            $table->string('motivo');
            $table->string('observacion');
            $table->timestamps();

            $table->foreign('idAsignacion')->references('idAsignacion')->on('asignaciones')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citacion_v2_s');
    }
};
