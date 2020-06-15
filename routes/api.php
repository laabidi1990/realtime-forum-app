<?php

use Illuminate\Http\Request;
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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('signup', 'AuthController@signup');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::apiResource('/questions', 'QuestionController')->except(['create', 'edit']);

Route::apiResource('/categories', 'CategoryController')->except(['create', 'edit']);

Route::apiResource('/questions/{question}/replies', 'ReplyController')->except(['create', 'edit']);

Route::post('/replies/{reply}/like', 'LikeController@like');

Route::delete('/replies/{reply}/dislike', 'LikeController@dislike');

Route::post('/notifications', 'NotificationsController@notifications');

Route::post('/notifications/mark-read', 'NotificationsController@markAsRead');