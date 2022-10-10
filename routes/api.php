<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TweetController;

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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/health', function(Request $request) {
    return "[twitter-markup-backend] alive!";
});

// Currently there is no auth module implemented,
// users endpoints only returns first user found on DB
Route::controller(UserController::class)->group(function () {
    Route::get('/users/me', 'me');
    Route::get('/users/followings', 'followingList');
    Route::post('/users/followings/{userId}', 'followUserById');
    Route::get('/users/followers', 'followersList');
});

Route::controller(TweetController::class)->group(function() {
    Route::get('/tweets', 'list');
    Route::post('/tweets', 'store');
    Route::get('/tweets/{tweetId}', 'show');

    Route::post('/tweets/favorites/{tweetId}', 'addFavorite');
    Route::delete('/tweets/favorites/{tweetId}', 'removeFavorite');
});
