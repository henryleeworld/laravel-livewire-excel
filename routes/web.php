<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('export', [HomeController::class, 'export'])->name('export');
Route::post('import', [HomeController::class, 'import'])->name('import');
