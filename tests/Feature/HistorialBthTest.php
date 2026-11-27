<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HistorialBthTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        foreach (['promedios_historicos_bth', 'notas', 'asignaciones', 'materias', 'inscripciones', 'estudiantes', 'cursos'] as $table) {
            Schema::dropIfExists($table);
        }

        Schema::create('cursos', function (Blueprint $table) {
            $table->string('id')->primary();
        });

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('id_estudiante')->primary();
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
        });

        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->string('id_estudiante');
            $table->string('id_curso');
            $table->unsignedBigInteger('id_gestion');
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->integer('id_materia')->primary();
            $table->string('area');
        });

        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('idAsignacion');
            $table->integer('id_materia');
            $table->string('idcurso');
            $table->unsignedBigInteger('id_gestion');
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->decimal('calificacion', 5, 2);
            $table->integer('periodo');
            $table->string('id_estudiante');
            $table->unsignedBigInteger('idAsignacion');
            $table->unsignedBigInteger('id_gestion');
        });

        Schema::create('promedios_historicos_bth', function (Blueprint $table) {
            $table->id();
            $table->string('id_estudiante', 10);
            $table->integer('id_materia');
            $table->unsignedSmallInteger('anio');
            $table->decimal('promedio', 5, 2);
            $table->timestamps();
            $table->unique(['id_estudiante', 'id_materia', 'anio']);
        });

        DB::table('cursos')->insert(['id' => 'C1']);
        DB::table('estudiantes')->insert([
            'id_estudiante' => 'E001',
            'nombres' => 'Ana',
            'appaterno' => 'Paz',
            'apmaterno' => 'Lopez',
        ]);
        DB::table('inscripciones')->insert([
            'id_estudiante' => 'E001',
            'id_curso' => 'C1',
            'id_gestion' => 1,
        ]);
        DB::table('materias')->insert([
            ['id_materia' => 10, 'area' => 'Matemática'],
            ['id_materia' => 20, 'area' => 'Lenguaje externo'],
        ]);
        DB::table('asignaciones')->insert([
            'id_materia' => 10,
            'idcurso' => 'C1',
            'id_gestion' => 1,
        ]);
        DB::table('notas')->insert([
            'calificacion' => 72,
            'periodo' => 1,
            'id_estudiante' => 'E001',
            'idAsignacion' => 1,
            'id_gestion' => 1,
        ]);
    }

    public function test_it_saves_editable_historical_averages_and_calculates_the_last_three_without_changing_current_grades(): void
    {
        $payload = [
            'id_curso' => 'C1',
            'promedios' => [
                10 => [
                    2022 => 70,
                    2023 => 75,
                    2024 => 80,
                    2025 => 90,
                    2026 => 100,
                ],
            ],
        ];

        $this->withSession(['gestion_activa' => 1])
            ->putJson('/estudiante/E001/historial-bth', $payload)
            ->assertOk()
            ->assertJsonPath('success', true);

        $this->assertDatabaseCount('promedios_historicos_bth', 5);
        $this->assertDatabaseHas('notas', ['id_estudiante' => 'E001', 'calificacion' => 72]);

        $this->withSession(['gestion_activa' => 1])
            ->getJson('/estudiante/E001/historial-bth?id_curso=C1')
            ->assertOk()
            ->assertJsonPath('materias.0.promedios.2026', 100)
            ->assertJsonPath('materias.0.promedio_ultimas_tres', 90);

        $payload['promedios'][10][2024] = null;
        $payload['promedios'][10][2026] = 98;

        $this->withSession(['gestion_activa' => 1])
            ->putJson('/estudiante/E001/historial-bth', $payload)
            ->assertOk();

        $this->assertDatabaseMissing('promedios_historicos_bth', [
            'id_estudiante' => 'E001',
            'id_materia' => 10,
            'anio' => 2024,
        ]);
        $this->withSession(['gestion_activa' => 1])
            ->getJson('/estudiante/E001/historial-bth?id_curso=C1')
            ->assertOk()
            ->assertJsonPath('materias.0.promedio_ultimas_tres', 94);
        $this->assertDatabaseHas('notas', ['id_estudiante' => 'E001', 'calificacion' => 72]);
    }

    public function test_it_rejects_historical_averages_for_subjects_outside_the_selected_course(): void
    {
        $this->withSession(['gestion_activa' => 1])
            ->putJson('/estudiante/E001/historial-bth', [
                'id_curso' => 'C1',
                'promedios' => [
                    20 => [
                        2022 => null,
                        2023 => null,
                        2024 => 80,
                        2025 => null,
                        2026 => null,
                    ],
                ],
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('promedios_historicos_bth', 0);
    }
}
