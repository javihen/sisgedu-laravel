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
        Schema::create('profesores', function (Blueprint $table) {
            $table->bigIncrements('id_profesor');
            $table->string('ci');
            $table->string('rda');
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->char('genero',1);
            $table->date('fechaNac')->nullable();
            $table->string('fuenteFinan');
            $table->string('nivelFormacion');
            $table->char('estado',1)->default('A');
            $table->string('observacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profesores');
    }
};
