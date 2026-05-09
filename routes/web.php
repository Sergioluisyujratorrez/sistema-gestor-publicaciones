<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PublicacionController;
use App\Models\Proyecto;
use App\Models\Publicacion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/galeria', function () {
    $publicaciones = Publicacion::with(['categoria', 'user'])
        ->where('estado', true)
        ->latest()
        ->paginate(12);

    return view('pages.gallery', compact('publicaciones'));
})->name('galeria');

Route::get('/proyectos', function () {
    $proyectos = Proyecto::with(['categoria', 'user'])
        ->where('estado', true)
        ->latest()
        ->paginate(12);

    return view('pages.projects', compact('proyectos'));
})->name('proyectos');

Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contacto');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/dashboard', function () {
        $publicaciones = \App\Models\Publicacion::with(['categoria', 'user'])->latest()->paginate(10);
        $proyectos     = \App\Models\Proyecto::with(['categoria', 'user'])->latest()->paginate(10);
        $categorias    = \App\Models\Categoria::where('estado', true)->orderBy('nombre')->get();
        $tecnologias   = \App\Models\Tecnologia::where('estado', true)->orderBy('nombre')->get();

        return view('dashboard.index', compact('publicaciones', 'proyectos', 'categorias', 'tecnologias'));
    })->name('dashboard');

    Route::get('/dashboard/publicaciones', [PublicacionController::class, 'index'])->name('dashboard.publicaciones');
    Route::post('/dashboard/publicaciones', [PublicacionController::class, 'store'])->name('dashboard.publicaciones.store');
    Route::put('/dashboard/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('dashboard.publicaciones.update');

    Route::get('/dashboard/proyectos', [ProyectoController::class, 'index'])->name('dashboard.proyectos');
    Route::post('/dashboard/proyectos', [ProyectoController::class, 'store'])->name('dashboard.proyectos.store');
    Route::put('/dashboard/proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('dashboard.proyectos.update');
});
