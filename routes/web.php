<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/galeria', function () {
    return view('pages.gallery');
})->name('galeria');

Route::get('/proyectos', function () {
    return view('pages.projects');
})->name('proyectos');

Route::get('/contacto', function () {
    return view('pages.contact');
})->name('contacto');

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->group(function (): void {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/dashboard/publicaciones', function () {
        return view('dashboard.publications');
    })->name('dashboard.publicaciones');

    Route::get('/dashboard/proyectos', function () {
        return view('dashboard.projects');
    })->name('dashboard.proyectos');
});
