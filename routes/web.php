<?php

use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/curso', function () {
    return view('curso.index');
}); */

//-------------- MODULO CURSO ---------------------//
Route::get('/curso', [CursoController::class, 'index'])->name('curso.index');
Route::post('/curso/store', [CursoController::class, 'store'])->name('curso.store');
Route::delete('/curso/destroy/{id}', [CursoController::class, 'destroy'])->name('curso.destroy');
Route::get('/curso/{turno}/{nivel}', [CursoController::class, 'getCursos'])->name('curso.getCursos');
// API: todos los cursos (para poblar selects)
Route::get('/cursos', [CursoController::class, 'listAll'])->name('curso.listAll');


//-------------- MODULO ESTUDIANTE --------------------//

Route::get('/estudiante', [EstudianteController::class, 'index'])->name('estudiante.index');
Route::post('/estudiante/store', [EstudianteController::class, 'store'])->name('estudiante.store');
Route::post('/estudiante/import', [EstudianteController::class, 'import'])->name('estudiante.import');
Route::delete('/estudiante/destroy/{id}', [EstudianteController::class, 'destroy'])->name('estudiante.destroy');
Route::put('/estudiante/{id}', [EstudianteController::class, 'update'])->name('estudiante.update');


//--------------- MODULO MATERIA ----------------------//
Route::get('/materia', [MateriaController::class, 'index'])->name('materia.index');
Route::post('/materia/store', [MateriaController::class, 'store'])->name('materia.store');
Route::delete('/materia/destroy/{id}', [MateriaController::class, 'destroy'])->name('materia.destroy');


//----------------- MODULO PROFESOR ------------------------//
Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor.index');
Route::post('/profesor/store', [ProfesorController::class, 'store'])->name('profesor.store');
Route::delete('/profesor/destroy/{id}', [ProfesorController::class, 'destroy'])->name('profesor.destroy');
Route::get('/profesor/perfil/{id}', [ProfesorController::class, 'perfil'])->name('profesor.perfil');
