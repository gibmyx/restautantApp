<?php
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth:sanctum', 'verified'])->get('/notifications/list', function () {
    return Inertia::render('Notifications/View/List');
})->name('notifications.list');
