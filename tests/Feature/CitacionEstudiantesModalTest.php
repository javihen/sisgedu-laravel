<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CitacionEstudiantesModalTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('inscripciones');
        Schema::dropIfExists('estudiantes');
        Schema::dropIfExists('cursos');

        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('display_name');
            $table->timestamps();
        });

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('id_estudiante')->primary();
            $table->string('nombres')->nullable();
            $table->string('appaterno')->nullable();
            $table->string('apmaterno')->nullable();
            $table->timestamps();
        });

        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->string('id_estudiante');
            $table->unsignedBigInteger('id_curso');
            $table->unsignedBigInteger('id_gestion')->nullable();
            $table->timestamps();
        });

        DB::table('cursos')->insert([
            ['id' => 999, 'display_name' => 'Curso de prueba'],
        ]);
    }

    public function test_it_returns_the_students_modal_partial_for_a_course(): void
    {
        $response = $this->get('/citacion/curso/999/estudiantes');

        $response->assertStatus(200);
        $response->assertSee('No hay estudiantes');
    }
}
