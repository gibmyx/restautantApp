<?php

use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\Clients\Controllers\ClientPostControllers;

Route::post('/client', ClientPostControllers::class);
