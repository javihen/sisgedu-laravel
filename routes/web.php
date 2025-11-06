<?php

use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/curso', function () {
    return view('curso.index');
}); */

Route::get('/curso', [CursoController::class, 'index'])->name('curso.index');
Route::post('/curso/store', [CursoController::class, 'store'])->name('curso.store');
