<?php

use Apps\Backend\restaurant\Reservations\Controllers\ReservationsGetController;
use Apps\Backend\restaurant\Reservations\Controllers\ReservationsHistoryGetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/reservations/list', function () {
    return Inertia::render('Reservations/View/List');
})->name('reservations.list');

Route::middleware(['auth:sanctum', 'verified'])->get('/reservations', ReservationsGetController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/reservations/history', ReservationsHistoryGetController::class);
