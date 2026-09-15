<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
    ]);
});

Route::prefix('v1')->middleware(\App\Http\Middleware\AuthenticateWithApiSecret::class)->group(function () {
    Route::apiResource('ipmrs', \App\Http\Controllers\IpmrController::class);
    Route::apiResource('ipmr', \App\Http\Controllers\IpmrController::class)->names('ipmr');
    Route::apiResource('ipmr_representatives', \App\Http\Controllers\IpmrRepresentativeController::class);
    Route::apiResource('ipmr_representative_terms', \App\Http\Controllers\IpmrRepresentativeTermController::class);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
