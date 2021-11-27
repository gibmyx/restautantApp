<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/clients/list', function () {
    return Inertia::render('Clients/View/List');
})->name('clients.list');
