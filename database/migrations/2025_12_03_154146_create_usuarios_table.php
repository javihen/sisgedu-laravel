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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('idUsuario');
            $table->string('username', 50)->unique();
            $table->string('email', 100)->nullable();
            $table->string('password');
            $table->boolean('estado')->default(1);

            $table->unsignedBigInteger('idRol');

            // Relación con persona
            $table->unsignedBigInteger('id_Profesor')->nullable();
            //$table->unsignedBigInteger('idEstudiante')->nullable();

            $table->timestamps();

            // Foreign keys
            $table->foreign('idRol')->references('idRol')->on('roles')->onDelete('cascade');

            $table->foreign('id_Profesor')->references('id_Profesor')->on('profesores')->onDelete('cascade');
            //$table->foreign('idEstudiante')->references('idEstudiante')->on('estudiante')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
