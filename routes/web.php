<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;

Route::get('/', [PrincipalController::class,'principal']);