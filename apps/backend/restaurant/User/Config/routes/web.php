<?php
use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\User\Controllers\UserPostControllers;
use Inertia\Inertia;



Route::post('/register', UserPostControllers::class);

Route::get('/', function () {
    return Inertia::render('LandingPage/Welcome');
})->name("Welcome");

Route::middleware(['auth:sanctum', 'verified'])->get('/user/profile', function () {
    return Inertia::render('User/View/Profile');
})->name('user.profile');

Route::middleware(['auth:sanctum', 'verified'])->get('/clients/list', function () {
    return Inertia::render('Clients/View/List');
})->name('clients.list');
