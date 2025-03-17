<?php

use App\Http\Middleware\ApiKeyAuth;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('/api/JWT', [WeatherController::class, 'getJWTToken']);
Route::middleware(ApiKeyAuth::class)->get('/api/weather', [WeatherController::class, 'getWeather']);
