<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


// Show Login/Register
Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('register', [HomeController::class,"showRegisterForm"])->name("registerForm");

// Login/Register function
Route::post('login', [HomeController::class,"login"])->name("login");
Route::post("registrar",[LoginController::class,"register"])->name("registrar");