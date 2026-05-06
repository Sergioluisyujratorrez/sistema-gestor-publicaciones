<?php

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

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
