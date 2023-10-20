<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BlogController;
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
        Route::group(['middleware' => 'is.blogOwner'], function () {
            Route::post('blog/new', [BlogController::class, 'create']);
            Route::put('blog/{post_id}', [BlogController::class, 'update']);
            Route::delete('blog/{post_id}', [BlogController::class, 'delete']);
        });
        Route::get('blogs/{user_id}', [BlogController::class, 'getOwnerBlogs'])->middleware('is.user');
    });

Route::get('blogs', [BlogController::class, 'getPublicBlogs']);
