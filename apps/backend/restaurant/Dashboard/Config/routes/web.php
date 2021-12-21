<?php

use Apps\Backend\restaurant\Dashboard\Controllers\DashboardInformationGetController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/information', DashboardInformationGetController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard/View/List');
})->name('dashboard');
