<?php

use App\Http\Controllers\Api\V1\Dashboard\AdminAnswerController;
use App\Http\Controllers\Api\V1\Dashboard\AdminAuthController;
use App\Http\Controllers\Api\V1\Dashboard\AdminExamController;
use App\Http\Controllers\Api\V1\Dashboard\AdminPaperController;
use App\Http\Controllers\Api\V1\Dashboard\AdminQuestionController;
use App\Http\Controllers\Api\V1\Dashboard\AdminScoreController;
use App\Http\Controllers\APi\V1\Dashboard\AdminUserController;
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
        Route::get('/user/profile', [UserAuthController::class, 'profile'])->middleware('auth:sanctum');
        // admin routes
        Route::post('/admin/register', [AdminAuthController::class, 'register'])->middleware('auth:sanctum', 'admin:supervisor');
        Route::post('/admin/login', [AdminAuthController::class, 'login']);
        Route::get('/admin/profile', [AdminAuthController::class, 'profile'])->middleware('auth:sanctum');
    });
    Route::group(
        [
            'prefix' => 'dashboard',
            'middleware' => ['auth:sanctum', 'admin:admin']
        ],
        function () {
            Route::post('/score/store', [AdminScoreController::class, 'store']);
            Route::get('users', [AdminUserController::class, 'index']);
        }
    );
    Route::group(
        [
            'prefix' => 'dashboard',
            'middleware' => ['auth:sanctum', 'admin:supervisor']
        ],
        function () {
            // exam routes
            Route::post('/exam/store', [AdminExamController::class, 'store']);
            // question routes
            Route::post('/question/store', [AdminQuestionController::class, 'store']);
            // answer routes
            Route::post('/answer/store', [AdminAnswerController::class, 'store']);
            // paper routes
            Route::get('papers', [AdminPaperController::class, 'index']);
            Route::post('/paper/store', [AdminPaperController::class, 'store']);
            Route::put('/paper/{paper}/finish-marking', [AdminPaperController::class, 'finish_marking']);
            // score routes
            Route::get('scores', [AdminScoreController::class, 'index']);
            Route::get('paper/{paper}/scores', [AdminPaperController::class, 'scores']);
            Route::get('score/{score}', [AdminScoreController::class, 'show']);
            Route::put('/score/{score}/update', [AdminScoreController::class, 'update']);
            // user routes
            Route::get('user/{user}', [AdminUserController::class, 'show']);
        }
    );
});