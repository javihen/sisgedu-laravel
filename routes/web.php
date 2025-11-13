<?php

use App\Http\Controllers\CursoController;
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


//-------------- MODULO ESTUDIANTE --------------------//
Route::get('/estudiante', function () {
    return view('estudiante.index');
})->name('estudiante.index');
