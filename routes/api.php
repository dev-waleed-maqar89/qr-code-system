<?php

use App\Http\Controllers\Api\V1\Main\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/user/register', [UserAuthController::class, 'register']);
        Route::post('/user/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');
    });
});