<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherController;
use Inertia\Inertia;

Route::get('/', function () {
  return Inertia::render('App');
});


Route::get('/weather', function () {
  return Inertia::render('Weather');
});
