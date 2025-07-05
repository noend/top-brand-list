<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\TopListController;
use App\Http\Controllers\Api\CountryController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware();

Route::apiResource('brands', BrandController::class)
    ->middleware('auth:sanctum');

Route::prefix('countries')->group(function () {
    Route::get('{country}/toplists', [CountryController::class, 'getTopList'])
        ->middleware('auth:sanctum');
    Route::put('{country}/toplists', [CountryController::class, 'updateTopList'])
        ->middleware('auth:sanctum');
    Route::delete('countries/{country}/toplists', [CountryController::class, 'destroyTopList'])
        ->middleware('auth:sanctum');
});
