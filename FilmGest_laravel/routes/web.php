<?php

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Route;

Route::resource('films', FilmController::class);

