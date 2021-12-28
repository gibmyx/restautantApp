<?php

use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\Tables\Controllers\TablesGetController;

Route::middleware(['auth:sanctum'])->get('/tables', TablesGetController::class);
