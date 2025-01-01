<?php

use App\Http\Controllers\LicenseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/check-license', [LicenseController::class, 'checkLicense']);
Route::post('/create-license', [LicenseController::class, 'createLicense']);
