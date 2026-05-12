<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\PublicacionController;
use App\Models\Categoria;
use App\Models\Proyecto;
use App\Models\Publicacion;
use App\Models\Tecnologia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/galeria', function (Request $request) {
    $q = trim((string) $request->query('q', ''));
    $tipo = $request->query('tipo');
    $categoriaId = $request->query('categoria');
    $desde = $request->query('desde');
    $hasta = $request->query('hasta');
    $orden = $request->query('orden', 'recientes');

    $publicaciones = Publicacion::with(['categoria', 'user'])
        ->where('estado', true)
        ->when($q !== '', fn ($query) => $query->where('titulo', 'like', "%{$q}%"))
        ->when(in_array($tipo, ['imagen', 'pdf', 'otro'], true), fn ($query) => $query->where('tipo', $tipo))
        ->when($categoriaId, fn ($query) => $query->where('categoria_id', $categoriaId))
        ->when($desde, fn ($query) => $query->whereDate('created_at', '>=', $desde))
        ->when($hasta, fn ($query) => $query->whereDate('created_at', '<=', $hasta))
        ->when($orden === 'antiguos', fn ($query) => $query->oldest(), fn ($query) => $query->latest())
        ->when($orden === 'az', fn ($query) => $query->reorder('titulo', 'asc'))
        ->paginate(12)
        ->withQueryString();

    $categorias = Categoria::where('estado', true)
        ->whereIn('tipo', ['publicacion', 'ambos'])
        ->orderBy('nombre')
        ->get();

    return view('pages.gallery', compact('publicaciones', 'categorias'));
})->name('galeria');

Route::get('/proyectos', function (Request $request) {
    $q = trim((string) $request->query('q', ''));
    $tipo = $request->query('tipo');
    $categoriaId = $request->query('categoria');
    $desde = $request->query('desde');
    $hasta = $request->query('hasta');
    $orden = $request->query('orden', 'recientes');

    $proyectos = Proyecto::with(['categoria', 'user'])
        ->where('estado', true)
        ->when($q !== '', fn ($query) => $query->where('titulo', 'like', "%{$q}%"))
        ->when(in_array($tipo, ['sitio_web', 'aplicacion', 'dashboard', 'tienda_online', 'otro'], true), fn ($query) => $query->where('tipo', $tipo))
        ->when($categoriaId, fn ($query) => $query->where('categoria_id', $categoriaId))
        ->when($desde, fn ($query) => $query->whereDate('created_at', '>=', $desde))
        ->when($hasta, fn ($query) => $query->whereDate('created_at', '<=', $hasta))
        ->when($orden === 'antiguos', fn ($query) => $query->oldest(), fn ($query) => $query->latest())
        ->when($orden === 'az', fn ($query) => $query->reorder('titulo', 'asc'))
        ->paginate(12)
        ->withQueryString();

    $categorias = Categoria::where('estado', true)
        ->whereIn('tipo', ['proyecto', 'ambos'])
        ->orderBy('nombre')
        ->get();

    return view('pages.projects', compact('proyectos', 'categorias'));
})->name('proyectos');

Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contacto');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/dashboard', function (Request $request) {
        $qPub = trim((string) $request->query('q_pub', ''));
        $tipoPub = $request->query('tipo_pub');
        $qProy = trim((string) $request->query('q_proy', ''));
        $tipoProy = $request->query('tipo_proy');

        $publicaciones = Publicacion::with(['categoria', 'user'])
            ->when($qPub !== '', fn ($query) => $query->where('titulo', 'like', "%{$qPub}%"))
            ->when(in_array($tipoPub, ['imagen', 'pdf', 'otro'], true), fn ($query) => $query->where('tipo', $tipoPub))
            ->latest()
            ->paginate(3, ['*'], 'pub_page')
            ->withQueryString();

        $proyectos = Proyecto::with(['categoria', 'user'])
            ->when($qProy !== '', fn ($query) => $query->where('titulo', 'like', "%{$qProy}%"))
            ->when(in_array($tipoProy, ['sitio_web', 'aplicacion', 'dashboard', 'tienda_online', 'otro'], true), fn ($query) => $query->where('tipo', $tipoProy))
            ->latest()
            ->paginate(3, ['*'], 'proy_page')
            ->withQueryString();

        $categorias = Categoria::where('estado', true)->orderBy('nombre')->get();
        $tecnologias = Tecnologia::where('estado', true)->orderBy('nombre')->get();

        return view('dashboard.index', compact('publicaciones', 'proyectos', 'categorias', 'tecnologias'));
    })->name('dashboard');

    Route::get('/dashboard/publicaciones', [PublicacionController::class, 'index'])->name('dashboard.publicaciones');
    Route::get('/dashboard/publicaciones/reporte', [PublicacionController::class, 'reporte'])->name('dashboard.publicaciones.reporte');
    Route::post('/dashboard/publicaciones', [PublicacionController::class, 'store'])->name('dashboard.publicaciones.store');
    Route::put('/dashboard/publicaciones/{publicacion}', [PublicacionController::class, 'update'])->name('dashboard.publicaciones.update');
    Route::patch('/dashboard/publicaciones/{publicacion}/toggle', [PublicacionController::class, 'toggleEstado'])->name('dashboard.publicaciones.toggle');

    Route::get('/dashboard/proyectos', [ProyectoController::class, 'index'])->name('dashboard.proyectos');
    Route::post('/dashboard/proyectos', [ProyectoController::class, 'store'])->name('dashboard.proyectos.store');
    Route::put('/dashboard/proyectos/{proyecto}', [ProyectoController::class, 'update'])->name('dashboard.proyectos.update');
    Route::patch('/dashboard/proyectos/{proyecto}/toggle', [ProyectoController::class, 'toggleEstado'])->name('dashboard.proyectos.toggle');

    Route::get('/dashboard/categorias', [CategoriaController::class, 'index'])->name('dashboard.categorias');
    Route::post('/dashboard/categorias', [CategoriaController::class, 'store'])->name('dashboard.categorias.store');
    Route::put('/dashboard/categorias/{categoria}', [CategoriaController::class, 'update'])->name('dashboard.categorias.update');
    Route::patch('/dashboard/categorias/{categoria}/toggle', [CategoriaController::class, 'toggleEstado'])->name('dashboard.categorias.toggle');
});
