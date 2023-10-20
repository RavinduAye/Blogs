<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

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


Route::group(['middleware' => 'is.blogOwner'], function () {
    Route::post('blogs/new', [BlogController::class, 'create']);
    Route::put('blogs/{post_id}', [BlogController::class, 'update']);
    Route::delete('blogs/{post_id}', [BlogController::class, 'delete']);
});

Route::get('blogs', [BlogController::class, 'getBlogs']);