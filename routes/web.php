<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarjetaController;

Route::get('/', [MainController::class, 'index']) -> name('main');



Route::view("about","about");
Route::view("noticias","noticias");
Route::view("alumnos","alumnos");

//Ruta de prueba para tarjeta 1
Route::get('/tarjeta/{id}', [TarjetaController::class, 'show'])->name('tarjeta.show');

//Pruebas de rutas parametrizadas
Route::get("/alumno/{numero}/{seccion}", fn($numero, $seccion) =>  view("alumno", ["numero" => $numero, "seccion" => $seccion]));

//Prueba de ruta propia por parametros
Route::get("/prueba/{parametro1}/{parametro2}", fn($parametro1, $parametro2) => view("prueba", ["parametro1" => $parametro1, 'parametro2' => $parametro2]));


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/projects', ProjectController::class);
Route::resource('/students', StudentController::class)->only(['store', 'update', 'destroy']);
Route::resource('/teachers', TeacherController::class)->only(['store', 'update', 'destroy']);



require __DIR__.'/auth.php';
