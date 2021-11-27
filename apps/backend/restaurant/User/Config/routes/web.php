<?php
use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\User\Controllers\UserPostControllers;
use Inertia\Inertia;



Route::post('/register', UserPostControllers::class);

Route::get('/', function () {
    return Inertia::render('LandingPage/Welcome');
})->name("Welcome");

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard/View/Main');
})->name('dashboard');
