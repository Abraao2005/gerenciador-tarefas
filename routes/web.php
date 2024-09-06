<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

/**
 * Adicione e modifique rotas conforme necessário
 */

Route::get('/', [HomeController::class, "index"]);
