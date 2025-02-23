<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\EFileController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => ['api'],
    'prefix' => 'users'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('logout', [UserController::class, 'logout']);
        Route::post('refresh', [UserController::class, 'refresh']);
        Route::get('me', [UserController::class, 'me']);
        Route::put('{user}', [UserController::class, 'update']);
        Route::delete('{user}', [UserController::class, 'destroy']);
    });
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::get('', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);
});

//sectors
Route::group([
    'middleware' => ['api'],
    'prefix' => 'sectors'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('', [SectorController::class, 'index']);
        Route::post('', [SectorController::class, 'store']);
        Route::get('{sector}', [SectorController::class, 'show']);
        Route::put('{sector}', [SectorController::class, 'update']);
    });
});

//services
Route::group([
    'middleware' => ['api'],
    'prefix' => 'services'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('', [ServiceController::class, 'index']);
        Route::post('', [ServiceController::class, 'store']);
        Route::get('{service}', [ServiceController::class, 'show']);
        Route::put('{service}', [ServiceController::class, 'update']);
        Route::delete('{service}', [ServiceController::class, 'destroy']);
    });
});

// efiles
Route::group([
    'middleware' => ['api'],
    'prefix' => 'efiles'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {

    });
    Route::post('/upload', [EFileController::class, 'upload']);
    Route::get('/{id}', [EFileController::class, 'read']);
    Route::delete('/{id}', [EFileController::class, 'delete']);
});

//chats
Route::group([
    'middleware' => ['api'],
    'prefix' => 'chats'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('', [ChatController::class, 'index']);
        Route::post('', [ChatController::class, 'store']);
        Route::get('{chat}', [ChatController::class, 'show']);
        Route::delete('{chat}', [ChatController::class, 'destroy']);
    });
});

//messages
Route::group([
    'middleware' => ['api'],
    'prefix' => 'messages'
], function ($router) {
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('', [MessageController::class, 'store']);
        Route::put('{message}', [MessageController::class, 'update']);
        Route::delete('{message}', [MessageController::class, 'destroy']);
    });
});
