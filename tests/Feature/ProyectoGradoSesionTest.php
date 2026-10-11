<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProyectoGradoSesionTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        foreach ([
            'proyecto_grado_asistencias',
            'proyecto_grado_sesiones',
            'proyecto_estudiantes',
            'proyectos_grado',
            'estudiantes',
        ] as $table) {
            Schema::dropIfExists($table);
        }

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('id_estudiante', 20)->primary();
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->string('ci')->nullable();
            $table->timestamps();
        });

        Schema::create('proyectos_grado', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->string('idEstudiante', 20);
            $table->unsignedBigInteger('idGestion');
            $table->string('titulo');
            $table->timestamps();
        });

        Schema::create('proyecto_estudiantes', function (Blueprint $table) {
            $table->increments('idproyecto_estudiantes');
            $table->unsignedBigInteger('idProyecto');
            $table->string('id_estudiante', 20);
            $table->timestamps();
        });

        Schema::create('proyecto_grado_sesiones', function (Blueprint $table) {
            $table->id('id_sesion');
            $table->unsignedBigInteger('idProyecto');
            $table->unsignedBigInteger('idGestion');
            $table->integer('numero_sesion');
            $table->date('fecha_programada');
            $table->time('hora_inicio')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('tipo_sesion', 50);
            $table->string('tema')->nullable();
            $table->text('observaciones')->nullable();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::create('proyecto_grado_asistencias', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->unsignedBigInteger('id_sesion');
            $table->string('id_estudiante', 20);
            $table->string('estado_asistencia');
            $table->time('hora_llegada')->nullable();
            $table->text('entregable')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('entregable_presentado')->default(false);
            $table->boolean('validado')->default(false);
            $table->timestamps();
            $table->unique(['id_sesion', 'id_estudiante']);
        });

        DB::table('estudiantes')->insert([
            [
                'id_estudiante' => 'E1',
                'nombres' => 'Ana',
                'appaterno' => 'Lopez',
                'apmaterno' => 'Rojas',
                'ci' => '123',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estudiante' => 'E2',
                'nombres' => 'Luis',
                'appaterno' => 'Perez',
                'apmaterno' => 'Mora',
                'ci' => '456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_estudiante' => 'E3',
                'nombres' => 'Eva',
                'appaterno' => 'Diaz',
                'apmaterno' => 'Sol',
                'ci' => '789',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('proyectos_grado')->insert([
            'idProyecto' => 31,
            'idEstudiante' => 'E1',
            'idGestion' => 2026,
            'titulo' => 'Proyecto de prueba',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('proyecto_estudiantes')->insert([
            [
                'idProyecto' => 31,
                'id_estudiante' => 'E1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'idProyecto' => 31,
                'id_estudiante' => 'E2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function test_it_lists_project_members_and_saves_a_session_with_all_attendance(): void
    {
        $this->getJson('/proyecto-grado/31/sesiones')
            ->assertOk()
            ->assertJsonPath('numero_siguiente', 1)
            ->assertJsonCount(2, 'integrantes');

        $response = $this->postJson('/proyecto-grado/31/sesiones', [
            'fecha_programada' => '2026-10-04',
            'hora_inicio' => '14:30',
            'hora_fin' => '16:00',
            'tema' => 'Avance del capítulo dos',
            'asistencias' => [
                [
                    'id_estudiante' => 'E1',
                    'estado_asistencia' => 'Presente',
                    'hora_llegada' => '14:28',
                    'entregable' => 'Borrador',
                    'entregable_presentado' => true,
                    'validado' => true,
                ],
                [
                    'id_estudiante' => 'E2',
                    'estado_asistencia' => 'Retraso',
                    'hora_llegada' => '14:35',
                    'validado' => true,
                ],
            ],
        ]);

        $response->assertCreated()
            ->assertJsonPath('sesion.numero_sesion', 1)
            ->assertJsonCount(2, 'sesion.asistencias');

        $this->assertDatabaseHas('proyecto_grado_sesiones', [
            'idProyecto' => 31,
            'idGestion' => 2026,
            'numero_sesion' => 1,
            'tema' => 'Avance del capítulo dos',
        ]);
        $this->assertDatabaseHas('proyecto_grado_asistencias', [
            'id_estudiante' => 'E1',
            'estado_asistencia' => 'Presente',
            'entregable_presentado' => true,
        ]);

        $this->getJson('/proyecto-grado/31/sesiones')
            ->assertOk()
            ->assertJsonPath('numero_siguiente', 2)
            ->assertJsonCount(1, 'sesiones');
    }

    public function test_it_rejects_attendance_for_a_student_outside_the_project(): void
    {
        $this->postJson('/proyecto-grado/31/sesiones', [
            'fecha_programada' => '2026-10-04',
            'asistencias' => [
                ['id_estudiante' => 'E1', 'estado_asistencia' => 'Presente'],
                ['id_estudiante' => 'E3', 'estado_asistencia' => 'Presente'],
            ],
        ])->assertUnprocessable()
            ->assertJsonValidationErrors('asistencias');

        $this->assertDatabaseCount('proyecto_grado_sesiones', 0);
        $this->assertDatabaseCount('proyecto_grado_asistencias', 0);
    }
}
