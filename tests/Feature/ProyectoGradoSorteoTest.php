<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProyectoGradoSorteoTest extends TestCase
{
    protected int $gestionId;

    protected function setUp(): void
    {
        parent::setUp();

        foreach ([
            'proyecto_grado_sorteo_detalles',
            'proyecto_grado_sorteos',
            'proyecto_tribunales',
            'proyecto_estudiantes',
            'proyectos_grado',
            'estudiantes',
            'profesores',
            'cursos',
            'gestiones',
        ] as $table) {
            Schema::dropIfExists($table);
        }

        Schema::create('gestiones', function (Blueprint $table) {
            $table->id('id_gestion');
            $table->integer('anio');
            $table->date('fechaI');
            $table->date('fechaF');
            $table->char('estado', 1)->default('A');
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
            $table->string('id_estudiante', 20)->primary();
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->timestamps();
        });

        Schema::create('profesores', function (Blueprint $table) {
            $table->id('id_profesor');
            $table->string('nombres');
            $table->string('appaterno');
            $table->string('apmaterno');
            $table->timestamps();
        });

        Schema::create('proyectos_grado', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->string('idEstudiante', 20);
            $table->unsignedBigInteger('idProfesorTutor');
            $table->string('idCurso');
            $table->unsignedBigInteger('idGestion');
            $table->string('titulo');
            $table->string('lineaInvestigacion')->nullable();
            $table->string('estado')->default('REGISTRADO');
            $table->timestamps();
        });

        Schema::create('proyecto_estudiantes', function (Blueprint $table) {
            $table->id('idproyecto_estudiantes');
            $table->unsignedBigInteger('idProyecto');
            $table->string('id_estudiante', 20);
            $table->timestamps();
        });

        Schema::create('proyecto_tribunales', function (Blueprint $table) {
            $table->id('idTribunal');
            $table->unsignedBigInteger('idProyecto');
            $table->unsignedBigInteger('idProfesor');
            $table->string('cargo');
            $table->timestamps();
        });

        Schema::create('proyecto_grado_sorteos', function (Blueprint $table) {
            $table->id('idSorteo');
            $table->unsignedBigInteger('idGestion');
            $table->timestamp('fechaSorteo')->useCurrent();
            $table->unsignedTinyInteger('numeroMesas')->default(5);
            $table->string('estado', 20)->default('borrador');
            $table->unsignedBigInteger('idUsuario')->nullable();
            $table->timestamps();
        });

        Schema::create('proyecto_grado_sorteo_detalles', function (Blueprint $table) {
            $table->id('idDetalle');
            $table->unsignedBigInteger('idSorteo');
            $table->unsignedBigInteger('idProyecto');
            $table->unsignedTinyInteger('numeroMesa');
            $table->unsignedSmallInteger('orden');
            $table->date('fechaDefensa');
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->timestamps();
        });

        $now = now();
        $this->gestionId = DB::table('gestiones')->insertGetId([
            'anio' => (int) $now->format('Y'),
            'fechaI' => $now->toDateString(),
            'fechaF' => $now->copy()->addYear()->toDateString(),
            'estado' => 'A',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('cursos')->insert([
            'id' => 'CURSO-1',
            'nombre_curso' => 'Sexto BTH',
            'turno' => 'M',
            'nivel' => 2,
            'grado' => 6,
            'paralelo' => 'A',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        DB::table('profesores')->insert([
            'id_profesor' => 1,
            'nombres' => 'Docente',
            'appaterno' => 'Prueba',
            'apmaterno' => 'Uno',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        for ($i = 1; $i <= 10; $i++) {
            $estudianteId = 'EST-' . $i;
            DB::table('estudiantes')->insert([
                'id_estudiante' => $estudianteId,
                'nombres' => 'Estudiante ' . $i,
                'appaterno' => 'Apellido',
                'apmaterno' => 'Prueba',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
            DB::table('proyectos_grado')->insert([
                'idProyecto' => $i,
                'idEstudiante' => $estudianteId,
                'idProfesorTutor' => 1,
                'idCurso' => 'CURSO-1',
                'idGestion' => $this->gestionId,
                'titulo' => 'Proyecto ' . $i,
                'estado' => 'REGISTRADO',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    public function test_it_only_saves_the_last_randomized_schedule_after_confirmation(): void
    {
        $this->withSession([
            'gestion_activa' => $this->gestionId,
            'usuario_id' => 7,
        ])->postJson('/proyecto-grado/sorteo/generar', [
            'numeroMesas' => 3,
            'fechaDefensa' => now()->addDay()->toDateString(),
        ])->assertOk()
            ->assertJsonPath('proyectos', 10)
            ->assertJsonPath('mesas', 3);

        $this->assertDatabaseCount('proyecto_grado_sorteos', 0);
        $this->assertDatabaseCount('proyecto_grado_sorteo_detalles', 0);

        $this->postJson('/proyecto-grado/sorteo/generar', [
            'numeroMesas' => 5,
            'fechaDefensa' => now()->addDays(2)->toDateString(),
        ])->assertOk()
            ->assertJsonPath('mesas', 5);

        $this->assertDatabaseCount('proyecto_grado_sorteos', 0);

        $this->postJson('/proyecto-grado/sorteo/confirmar')
            ->assertOk()
            ->assertJsonPath('message', 'El cronograma fue confirmado y registrado correctamente.');

        $this->assertDatabaseCount('proyecto_grado_sorteos', 1);
        $this->assertDatabaseHas('proyecto_grado_sorteos', [
            'idGestion' => $this->gestionId,
            'numeroMesas' => 5,
            'estado' => 'confirmado',
            'idUsuario' => 7,
        ]);
        $this->assertDatabaseCount('proyecto_grado_sorteo_detalles', 10);
        $this->assertSame(
            10,
            DB::table('proyecto_grado_sorteo_detalles')->distinct()->count('idProyecto')
        );
        $this->assertSame(
            [2, 2, 2, 2, 2],
            DB::table('proyecto_grado_sorteo_detalles')
                ->select('numeroMesa', DB::raw('COUNT(*) as total'))
                ->groupBy('numeroMesa')
                ->orderBy('numeroMesa')
                ->pluck('total')
                ->all()
        );
        $this->assertDatabaseHas('proyecto_grado_sorteo_detalles', [
            'fechaDefensa' => now()->addDays(2)->toDateString(),
            'horaInicio' => '08:00:00',
            'horaFin' => '08:30:00',
        ]);
    }

    public function test_it_rejects_confirmation_without_a_generated_schedule(): void
    {
        $this->withSession(['gestion_activa' => $this->gestionId])
            ->postJson('/proyecto-grado/sorteo/confirmar')
            ->assertUnprocessable()
            ->assertJsonValidationErrors('sorteo');

        $this->assertDatabaseCount('proyecto_grado_sorteos', 0);
    }

    public function test_it_uses_the_requested_turn_closing_times_and_exports_the_confirmed_draw_as_pdf(): void
    {
        $fechaDefensa = now()->addDay()->toDateString();

        $this->withSession(['gestion_activa' => $this->gestionId])
            ->postJson('/proyecto-grado/sorteo/generar', [
                'numeroMesas' => 1,
                'fechaDefensa' => $fechaDefensa,
            ])
            ->assertOk()
            ->assertJsonPath('mesas', 1);

        $this->postJson('/proyecto-grado/sorteo/confirmar')->assertOk();

        $this->assertSame(
            [
                ['08:00:00', '08:30:00'],
                ['08:30:00', '09:00:00'],
                ['09:00:00', '09:30:00'],
                ['09:30:00', '10:00:00'],
                ['10:00:00', '10:30:00'],
                ['10:30:00', '11:00:00'],
                ['11:00:00', '11:30:00'],
                ['11:30:00', '12:00:00'],
                ['12:00:00', '12:30:00'],
                ['13:00:00', '13:30:00'],
            ],
            DB::table('proyecto_grado_sorteo_detalles')
                ->orderBy('orden')
                ->get(['horaInicio', 'horaFin'])
                ->map(fn ($detalle) => [$detalle->horaInicio, $detalle->horaFin])
                ->all()
        );

        $response = $this->get('/proyecto-grado/sorteo/pdf');
        $response->assertOk()
            ->assertHeader('content-type', 'application/pdf');
        $this->assertStringStartsWith('%PDF', $response->getContent());
    }

    public function test_it_rejects_a_table_count_greater_than_the_project_count(): void
    {
        $this->withSession(['gestion_activa' => $this->gestionId])
            ->postJson('/proyecto-grado/sorteo/generar', [
                'numeroMesas' => 11,
                'fechaDefensa' => now()->addDay()->toDateString(),
            ])
            ->assertUnprocessable()
            ->assertJsonValidationErrors('numeroMesas');

        $this->assertDatabaseCount('proyecto_grado_sorteos', 0);
    }
}
