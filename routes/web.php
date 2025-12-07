<?php

use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\GestionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// ------------------------- MODULO LOGIN ------------------------//
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//------------------------- MODULO GESTION --------------------------//
Route::get('/panel', function(){
    return view('panel');
});
Route::get('/panel',[GestionController::class, 'index'])->name('panel');
Route::post('/gestion/store',[GestionController::class, 'store'])->name('gestion.store');
Route::post('/gestion/cambiar-estado/{id}', [GestionController::class, 'cambiarEstado'])->name('gestion.cambiarEstado');

//-------------- MODULO CURSO ---------------------//
Route::get('/curso', [CursoController::class, 'index'])->name('curso.index')->middleware('role:2');
Route::post('/curso/store', [CursoController::class, 'store'])->name('curso.store');
Route::delete('/curso/destroy/{id}', [CursoController::class, 'destroy'])->name('curso.destroy');
Route::get('/curso/{turno}/{nivel}', [CursoController::class, 'getCursos'])->name('curso.getCursos');
// API: todos los cursos (para poblar selects)
Route::get('/cursos', [CursoController::class, 'listAll'])->name('curso.listAll');
Route::get('/cursos/nivel/{nivel}', [CursoController::class, 'getCursosNivel'])->name('curso.getCursosNivel');

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
Route::get('/materia/nivel/{nivel}', [MateriaController::class, 'getMateriasByNivel'])->name('materia.getMateriasByNivel');

//----------------- MODULO PROFESOR ------------------------//
Route::get('/profesor', [ProfesorController::class, 'index'])->name('profesor.index');
Route::post('/profesor/store', [ProfesorController::class, 'store'])->name('profesor.store');
Route::delete('/profesor/destroy/{id}', [ProfesorController::class, 'destroy'])->name('profesor.destroy');
Route::get('/profesor/perfil/{id}', [ProfesorController::class, 'perfil'])->name('profesor.perfil');
Route::put('/profesor/{id}', [ProfesorController::class, 'update'])->name('profesor.update');
Route::post('/profesor/cambiar-estado/{id}', [ProfesorController::class, 'cambiarEstado'])->name('profesor.cambiarEstado');


//-------------------- MODULO ASIGNACION --------------------//
Route::post('/asignacion/store',[AsignacionController::class, 'store'])->name('asignacion.store');
Route::delete('/asignacion/destroy/{id}', [AsignacionController::class, 'destroy'])->name('asignacion.destroy');
