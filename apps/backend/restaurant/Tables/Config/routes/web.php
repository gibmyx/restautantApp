<?php

use Apps\Backend\restaurant\Tables\Controllers\TablesGetController;
use Apps\Backend\restaurant\Tables\Controllers\TablesPutController;
use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\Tables\Controllers\TablePostController;
use Inertia\Inertia;


Route::middleware(['auth:sanctum', 'verified'])->get('/tables/list', function () {
    return Inertia::render('Tables/View/List');
})->name('tables.list');

Route::middleware(['auth:sanctum', 'verified'])->post('/table/{id}', TablePostController::class);
Route::middleware(['auth:sanctum', 'verified'])->put('/table', TablesPutController::class);
Route::middleware(['auth:sanctum', 'verified'])->get('/tables', TablesGetController::class);
