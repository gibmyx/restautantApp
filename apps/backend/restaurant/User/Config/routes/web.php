<?php
use Illuminate\Support\Facades\Route;
use Apps\Backend\restaurant\User\Controllers\UserPostControllers;



Route::post('/register', UserPostControllers::class);
