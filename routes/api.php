<?php

use App\Http\Controllers\RateController;
use Illuminate\Support\Facades\Route;

Route::get('/rate', [RateController::class, 'getRate']);
