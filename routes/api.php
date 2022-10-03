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


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/health', function(Request $request) {
    return "[twitter-markup-backend] alive!";
});

Route::get('/tweets', function(Request $request) {
    // TODO: Tweet一覧を表示するようにする
    return "[twitter-markup-backend] This is tweets [GET] endpoint";
});


Route::post('/tweets', function (Request $request) {
    // TODO: Tweetを新規作成できるようにする
    return "[twitter-markup-backend] This is tweets [GET] endpoint";
});
