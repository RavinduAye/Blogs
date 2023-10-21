<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::post('blogs', [BlogController::class, 'create']);
        Route::group(['middleware' => 'is.blogOwner'], function () {
            Route::put('blogs/{post_id}', [BlogController::class, 'update']);
            Route::delete('blogs/{post_id}', [BlogController::class, 'delete']);
        });
    });

// get public posts endpoint
Route::get('/blogs', [BlogController::class, 'findAll']);

Route::get('blogs/{post_id}', [BlogController::class, 'findOne']);

// login and register endpoints
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
