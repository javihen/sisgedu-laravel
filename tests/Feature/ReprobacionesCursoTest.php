<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ReprobacionesCursoTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        foreach (['notas', 'asignaciones', 'materias', 'profesores', 'inscripciones', 'estudiantes', 'cursos', 'gestiones'] as $table) {
            Schema::dropIfExists($table);
        }

        Schema::create('gestiones', function (Blueprint $table) {
            $table->id('id_gestion');
            $table->integer('anio');
            $table->date('fechaI');
            $table->date('fechaF');
            $table->char('estado', 1)->default('I');
            $table->timestamps();
        });

        Schema::create('cursos', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nombre_curso');
            $table->char('turno');
            $table->integer('nivel');
            $table->integer('grado');
            $table->char('paralelo');
            $table->timestamps();
        });

        Schema::create('estudiantes', function (Blueprint $table) {
            $table->string('id_estudiante')->primary();
            $table->string('rude')->nullable();
            $table->string('ci')->nullable();
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->char('genero', 1)->nullable();
            $table->char('estado', 1);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();
        });

        Schema::create('inscripciones', function (Blueprint $table) {
            $table->id('id_inscripcion');
            $table->string('id_estudiante');
            $table->string('id_curso');
            $table->unsignedBigInteger('id_gestion');
            $table->timestamps();
        });

        Schema::create('materias', function (Blueprint $table) {
            $table->integer('id_materia')->primary();
            $table->integer('nivel');
            $table->string('campo');
            $table->string('area');
            $table->string('abreviatura');
            $table->integer('orden');
            $table->timestamps();
        });

        Schema::create('profesores', function (Blueprint $table) {
            $table->id('id_profesor');
            $table->string('ci');
            $table->string('rda');
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->char('genero', 1);
            $table->date('fechaNac')->nullable();
            $table->string('fuenteFinan');
            $table->string('nivelFormacion');
            $table->char('estado', 1)->default('I');
            $table->string('observacion')->nullable();
            $table->timestamps();
        });

        Schema::create('asignaciones', function (Blueprint $table) {
            $table->id('idAsignacion');
            $table->integer('id_materia');
            $table->string('idcurso');
            $table->unsignedBigInteger('id_profesor');
            $table->unsignedBigInteger('id_gestion');
            $table->timestamps();
        });

        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->decimal('calificacion', 5, 2);
            $table->integer('periodo');
            $table->string('id_estudiante');
            $table->unsignedBigInteger('idAsignacion');
            $table->unsignedBigInteger('id_gestion');
            $table->timestamps();
        });

        $this->createAcademicFixture();
    }

    public function test_it_lists_only_failing_subjects_for_enrolled_students_in_the_selected_course(): void
    {
        $response = $this->withSession(['gestion_activa' => 1])
            ->get('/curso/C21A/reprobaciones');

        $response->assertOk()
            ->assertSee('Estudiante Uno Reprobado')
            ->assertSee('Materia reprobada')
            ->assertDontSee('Estudiante Dos Aprobado')
            ->assertDontSee('Estudiante Tres Limite')
            ->assertDontSee('Materia aprobada')
            ->assertDontSee('Materia de otro curso')
            ->assertSee('50 pts')
            ->assertDontSee('50.33')
            ->assertDontSee('50.99')
            ->assertSee('materia reprobada');
    }

    public function test_the_report_card_can_be_limited_to_the_selected_course(): void
    {
        $response = $this->withSession(['gestion_activa' => 1])
            ->getJson('/boletin/E001/json?id_curso=C21A');

        $response->assertOk()
            ->assertJsonCount(2, 'asignaciones')
            ->assertJsonPath('asignaciones.0.materia', 'Materia reprobada')
            ->assertJsonPath('asignaciones.0.notas.1', 51);

        $this->assertNotContains(
            'Materia de otro curso',
            array_column($response->json('asignaciones'), 'materia')
        );
    }

    public function test_it_generates_a_course_centralizer_pdf(): void
    {
        $response = $this->withSession(['gestion_activa' => 1])
            ->get('/curso/C21A/centralizador-notas.pdf');

        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');

        $this->assertStringStartsWith('%PDF', $response->getContent());
    }

    private function createAcademicFixture(): void
    {
        DB::table('gestiones')->insert([
            'id_gestion' => 1,
            'anio' => 2026,
            'fechaI' => '2026-01-01',
            'fechaF' => '2026-12-31',
            'estado' => 'A',
        ]);

        DB::table('cursos')->insert([
            ['id' => 'C21A', 'nombre_curso' => 'M21A', 'turno' => 'M', 'nivel' => 2, 'grado' => 1, 'paralelo' => 'A'],
            ['id' => 'C21B', 'nombre_curso' => 'M21B', 'turno' => 'M', 'nivel' => 2, 'grado' => 1, 'paralelo' => 'B'],
        ]);

        DB::table('estudiantes')->insert([
            ['id_estudiante' => 'E001', 'rude' => 'RUDE-1', 'nombres' => 'Reprobado', 'appaterno' => 'Estudiante', 'apmaterno' => 'Uno', 'estado' => 'E'],
            ['id_estudiante' => 'E002', 'rude' => 'RUDE-2', 'nombres' => 'Aprobado', 'appaterno' => 'Estudiante', 'apmaterno' => 'Dos', 'estado' => 'E'],
            ['id_estudiante' => 'E003', 'rude' => 'RUDE-3', 'nombres' => 'Limite', 'appaterno' => 'Estudiante', 'apmaterno' => 'Tres', 'estado' => 'E'],
        ]);

        DB::table('inscripciones')->insert([
            ['id_estudiante' => 'E001', 'id_curso' => 'C21A', 'id_gestion' => 1],
            ['id_estudiante' => 'E002', 'id_curso' => 'C21A', 'id_gestion' => 1],
            ['id_estudiante' => 'E003', 'id_curso' => 'C21A', 'id_gestion' => 1],
        ]);

        DB::table('profesores')->insert([
            'id_profesor' => 1,
            'ci' => 'CI-1',
            'rda' => 'RDA-1',
            'nombres' => 'Docente',
            'appaterno' => 'Prueba',
            'apmaterno' => 'Uno',
            'genero' => 'M',
            'fuenteFinan' => 'Fiscal',
            'nivelFormacion' => 'Licenciatura',
        ]);

        DB::table('materias')->insert([
            ['id_materia' => 1, 'nivel' => 2, 'campo' => 'Campo', 'area' => 'Materia reprobada', 'abreviatura' => 'MR', 'orden' => 1],
            ['id_materia' => 2, 'nivel' => 2, 'campo' => 'Campo', 'area' => 'Materia aprobada', 'abreviatura' => 'MA', 'orden' => 2],
            ['id_materia' => 3, 'nivel' => 2, 'campo' => 'Campo', 'area' => 'Materia de otro curso', 'abreviatura' => 'MO', 'orden' => 3],
        ]);

        DB::table('asignaciones')->insert([
            ['idAsignacion' => 1, 'id_materia' => 1, 'idcurso' => 'C21A', 'id_profesor' => 1, 'id_gestion' => 1],
            ['idAsignacion' => 2, 'id_materia' => 2, 'idcurso' => 'C21A', 'id_profesor' => 1, 'id_gestion' => 1],
            ['idAsignacion' => 3, 'id_materia' => 3, 'idcurso' => 'C21B', 'id_profesor' => 1, 'id_gestion' => 1],
        ]);

        $notas = [];
        foreach ([1 => [50.99, 50, 50], 2 => [70, 70, 70]] as $asignacionId => $calificaciones) {
            foreach ($calificaciones as $indice => $calificacion) {
                $notas[] = [
                    'calificacion' => $calificacion,
                    'periodo' => $indice + 1,
                    'id_estudiante' => 'E001',
                    'idAsignacion' => $asignacionId,
                    'id_gestion' => 1,
                ];
            }
        }

        foreach ([1 => [51, 51, 51], 2 => [60, 60, 60], 3 => [10, 10, 10]] as $asignacionId => $calificaciones) {
            foreach ($calificaciones as $indice => $calificacion) {
                $notas[] = [
                    'calificacion' => $calificacion,
                    'periodo' => $indice + 1,
                    'id_estudiante' => 'E002',
                    'idAsignacion' => $asignacionId,
                    'id_gestion' => 1,
                ];
            }
        }

        foreach ([51, 50, 50.5] as $indice => $calificacion) {
            $notas[] = [
                'calificacion' => $calificacion,
                'periodo' => $indice + 1,
                'id_estudiante' => 'E003',
                'idAsignacion' => 1,
                'id_gestion' => 1,
            ];
        }

        DB::table('notas')->insert($notas);
    }
}
