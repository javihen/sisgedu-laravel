
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_grado_sorteo_detalles', function (Blueprint $table) {
            $table->bigIncrements('idDetalle');

            $table->unsignedBigInteger('idSorteo');

            $table->unsignedBigInteger('idProyecto');

            $table->unsignedTinyInteger('numeroMesa');

            $table->unsignedSmallInteger('orden');

            $table->date('fechaDefensa');

            $table->time('horaInicio');

            $table->time('horaFin');

            $table->timestamps();

            // Un proyecto no puede repetirse dentro del mismo sorteo.
            $table->unique(
                ['idSorteo', 'idProyecto'],
                'pgsd_sorteo_proyecto_uq'
            );

            // Evita repetir una posición en la misma mesa del sorteo.
            $table->unique(
                ['idSorteo', 'numeroMesa', 'orden'],
                'pgsd_sorteo_mesa_orden_uq'
            );

            $table->index(
                ['idSorteo', 'numeroMesa'],
                'pgsd_sorteo_mesa_idx'
            );

            $table->foreign('idSorteo', 'pgsd_sorteo_fk')
                ->references('idSorteo')
                ->on('proyecto_grado_sorteos')
                ->cascadeOnDelete();

            $table->foreign('idProyecto', 'pgsd_proyecto_fk')
                ->references('idProyecto')
                ->on('proyectos_grado')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_grado_sorteo_detalles');
    }
};
