<?php

namespace Tests\Feature;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProyectoGradoDictamenTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('proyecto_seguimientos');
        Schema::dropIfExists('proyectos_grado');

        Schema::create('proyectos_grado', function (Blueprint $table) {
            $table->id('idProyecto');
            $table->unsignedBigInteger('idProfesorTutor');
            $table->timestamps();
        });

        Schema::create('proyecto_seguimientos', function (Blueprint $table) {
            $table->id('idSeguimiento');
            $table->unsignedBigInteger('idProyecto');
            $table->date('fecha');
            $table->string('titulo', 200);
            $table->text('descripcion');
            $table->integer('porcentaje')->default(0);
            $table->text('observacion')->nullable();
            $table->timestamps();
        });

        \DB::table('proyectos_grado')->insert([
            'idProyecto' => 31,
            'idProfesorTutor' => 7,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function test_it_saves_and_updates_the_official_dictamen_for_the_selected_project(): void
    {
        $payload = [
            'idProyecto' => 31,
            'dictamen_estado' => 'en_lectura',
            'fecha_dictamen' => '2026-10-21',
            'tipo_resolucion' => 'unanimidad',
            'observaciones' => 'Revisar marco metodológico.',
            'declaracion_jurada' => '1',
        ];

        $this->withSession(['profesor_id' => 7])
            ->post('/proyecto-grado/31/dictamen', $payload)
            ->assertRedirect();
        $this->assertDatabaseHas('proyecto_seguimientos', [
            'idProyecto' => 31,
            'fecha' => '2026-10-21 00:00:00',
            'titulo' => 'Dictamen oficial: En lectura metodológica',
            'descripcion' => 'Aprobado por Unanimidad (2/2)',
            'observacion' => 'Revisar marco metodológico.',
        ]);

        $payload['dictamen_estado'] = 'informe_favorable';
        $payload['fecha_dictamen'] = '2026-10-22';
        $this->withSession(['profesor_id' => 7])
            ->post('/proyecto-grado/31/dictamen', $payload)
            ->assertRedirect();

        $this->assertDatabaseCount('proyecto_seguimientos', 1);
        $this->assertDatabaseHas('proyecto_seguimientos', [
            'idProyecto' => 31,
            'fecha' => '2026-10-22 00:00:00',
            'titulo' => 'Dictamen oficial: Informe favorable',
        ]);
    }

    public function test_it_prevents_changes_after_the_project_is_enabled_for_defense(): void
    {
        \DB::table('proyecto_seguimientos')->insert([
            'idProyecto' => 31,
            'fecha' => '2026-10-21',
            'titulo' => 'Dictamen oficial: Habilitado para la defensa',
            'descripcion' => 'Aprobado por Unanimidad (2/2)',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->withSession(['profesor_id' => 7])
            ->post('/proyecto-grado/31/dictamen', [
            'idProyecto' => 31,
            'dictamen_estado' => 'en_lectura',
            'fecha_dictamen' => '2026-10-22',
            'tipo_resolucion' => 'unanimidad',
            'declaracion_jurada' => '1',
        ])->assertForbidden();

        $this->assertDatabaseHas('proyecto_seguimientos', [
            'idProyecto' => 31,
            'titulo' => 'Dictamen oficial: Habilitado para la defensa',
        ]);
    }

    public function test_it_forbids_a_professor_who_is_not_the_designated_tutor(): void
    {
        $this->withSession(['profesor_id' => 8])
            ->post('/proyecto-grado/31/dictamen', [
                'idProyecto' => 31,
                'dictamen_estado' => 'en_lectura',
                'fecha_dictamen' => '2026-10-22',
                'tipo_resolucion' => 'unanimidad',
                'declaracion_jurada' => '1',
            ])
            ->assertForbidden();

        $this->assertDatabaseCount('proyecto_seguimientos', 0);
    }
}
