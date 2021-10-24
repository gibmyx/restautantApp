<?php

use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\User\Controllers\UserPostControllers;
use Apps\Backend\restaurant\User\Controllers\UserAuthApiController;

Route::post('/register', UserPostControllers::class);
Route::post('/user/auth', UserAuthApiController::class);
