<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;

Route::get('/', [PrincipalController::class,'principal'])->name('site.principal');
Route::post('/', [PrincipalController::class,'principal'])->name('site.principal');