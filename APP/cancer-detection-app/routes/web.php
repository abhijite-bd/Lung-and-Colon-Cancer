<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Http\Controllers\PredictController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/colon', function () {
    return view('upload', ['type' => 'colon']);
});

Route::get('/lung', function () {
    return view('upload', ['type' => 'lung']);
});


Route::post('/generate-report', [ReportController::class, 'generateReport'])->name('generate.report');
Route::post('/predict', [PredictController::class, 'predict']);
