<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;


// Show Login/Register
Route::get('/', [HomeController::class, "index"])->name("home");
Route::get('register', [HomeController::class, "showRegisterForm"])->name("registerForm");




// Login/Register function
Route::post('login', [LoginController::class, "login"])->name("login");
Route::post("registrar", [LoginController::class, "register"])->name("registrar");


// Show Dashboard

Route::get('dashboard', [DashboardController::class, "showDashboard"])->name("dashboard");


// Tarefas Actions

Route::post("tarefaSave", [DashboardController::class, "tarefaSave"])->name("tarefaSave");
Route::post("tarefaUpdate", [DashboardController::class, "tarefaUpdate"])->name("tarefaUpdate");
Route::get("tarefaDelete", [DashboardController::class, "tarefaDelete"])->name("tarefaDelete");
