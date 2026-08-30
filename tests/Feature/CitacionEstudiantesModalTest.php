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

    public function test_toggle_registro_works_when_system_config_is_missing(): void
    {
        Schema::dropIfExists('detalle_citaciones');
        Schema::dropIfExists('citacion_v2_s');

        Schema::create('citacion_v2_s', function (Blueprint $table) {
            $table->bigIncrements('idCitacionV2');
            $table->unsignedBigInteger('idAsignacion');
            $table->date('fecha');
            $table->time('hora');
            $table->string('estado')->default('ABIERTO');
            $table->string('motivo')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();
        });

        Schema::create('detalle_citaciones', function (Blueprint $table) {
            $table->bigIncrements('idDetalleCitacion');
            $table->string('estado');
            $table->string('observacion');
            $table->string('id_estudiante');
            $table->unsignedBigInteger('idCitacionV2');
            $table->timestamps();
        });

        DB::table('citacion_v2_s')->insert([
            'idAsignacion' => 10,
            'fecha' => '2026-08-17',
            'hora' => '09:00:00',
            'estado' => 'ABIERTO',
            'motivo' => 'Aula Abierta',
            'observacion' => '',
        ]);

        $response = $this->postJson('/citacion/toggle-registro', [
            'idEstudiante' => 'E-001',
            'idAsignacion' => 10,
        ]);

        $response->assertOk();
        $response->assertJsonPath('success', true);
        $this->assertDatabaseHas('detalle_citaciones', [
            'id_estudiante' => 'E-001',
            'idCitacionV2' => 1,
        ]);
    }
}
