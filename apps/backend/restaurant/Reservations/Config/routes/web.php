<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/reservations/list', function () {
    return Inertia::render('Reservations/View/List');
})->name('reservations.list');
