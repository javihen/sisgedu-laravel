
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proyecto_grado_sorteos', function (Blueprint $table) {
            $table->bigIncrements('idSorteo');

            $table->unsignedBigInteger('idGestion');

            $table->timestamp('fechaSorteo')->useCurrent();

            $table->unsignedTinyInteger('numeroMesas')
                ->default(5);

            $table->string('estado', 20)
                ->default('borrador');

            $table->unsignedBigInteger('idUsuario')
                ->nullable();

            $table->timestamps();

            $table->index(
                ['idGestion', 'estado'],
                'pgs_gestion_estado_idx'
            );

            $table->foreign('idGestion', 'pgs_gestion_fk')
                ->references('id_gestion')
                ->on('gestiones')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyecto_grado_sorteos');
    }
};
