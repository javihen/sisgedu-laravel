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
        Schema::create('compromisos', function (Blueprint $table) {
            $table->bigIncrements('idCompromiso');
            $table->unsignedBigInteger('idEntrevista');
            $table->text('descripcion');
            $table->string('responsable');
            $table->date('fechaLimite');
            $table->string('estado')->default('pendiente');
            $table->date('fechaCumplimiento')->nullable();
            $table->timestamps();

            // Relación foránea
            $table->foreign('idEntrevista')
                ->references('idEntrevista')
                ->on('entrevistas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compromisos');
    }
};
