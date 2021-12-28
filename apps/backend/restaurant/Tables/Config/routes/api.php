<?php

use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\Tables\Controllers\TablesGetController;

Route::middleware(['auth:sanctum'])->put('/tables', TablesGetController::class);
