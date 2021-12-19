<?php

use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\Clients\Controllers\ClientsGetController;

Route::middleware(['auth:sanctum', 'verified'])->get('/clients', ClientsGetController::class);
