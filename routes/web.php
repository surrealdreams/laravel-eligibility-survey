<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    // Set default pat to a blank survey
    return to_route('surveys.create');
});

Route::resource('surveys', SurveyController::class)->only('index', 'create', 'store', 'show');
