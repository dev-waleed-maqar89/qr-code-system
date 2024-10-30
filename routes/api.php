<?php

use App\Http\Controllers\Api\V1\Dashboard\AdminAnswerController;
use App\Http\Controllers\Api\V1\Dashboard\AdminAuthController;
use App\Http\Controllers\Api\V1\Dashboard\AdminExamController;
use App\Http\Controllers\Api\V1\Dashboard\AdminQuestionController;
use App\Http\Controllers\Api\V1\Main\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        // user routes
        Route::post('/user/register', [UserAuthController::class, 'register']);
        Route::post('/user/login', [UserAuthController::class, 'login']);
        Route::post('/user/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');
        // admin routes
        Route::post('/admin/register', [AdminAuthController::class, 'register']);
        Route::post('/admin/login', [AdminAuthController::class, 'login']);
    });
    Route::group(
        [
            'prefix' => 'dashboard',
            'middleware' => ['auth:sanctum', 'admin:supervisor,admin,editor']
        ],
        function () {
            // exam routes
            Route::post('/exam/store', [AdminExamController::class, 'store']);
            // question routes
            Route::post('/question/store', [AdminQuestionController::class, 'store']);
            // answer routes
            Route::post('/answer/store', [AdminAnswerController::class, 'store']);
        }
    );
});