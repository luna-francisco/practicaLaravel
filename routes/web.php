<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name("main");

Route::view("about","about");
Route::view("noticias","noticias");
Route::view("alumnos","alumnos");
Route::view("profesores","profesores");

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

require __DIR__.'/auth.php';
