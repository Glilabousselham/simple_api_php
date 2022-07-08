<?php

use App\Controllers\EtudiantController;
use App\Http\Route;

Route::get("/etudiant",[EtudiantController::class, "getall"]);
Route::post("/etudiant", [EtudiantController::class, "create"]);