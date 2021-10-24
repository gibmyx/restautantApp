<?php

use Apps\Backend\restaurant\Reservations\Controllers\ReservationPostController;
use Apps\Backend\restaurant\Reservations\Controllers\ReservationPutController;
use Apps\Backend\restaurant\Reservations\Controllers\ReservationsGetController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->post("/reservation/{id}", ReservationPostController::class);
Route::middleware(['auth:sanctum'])->get("/reservations", ReservationsGetController::class);
Route::middleware(['auth:sanctum'])->put("/reservation", ReservationPutController::class);

