<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\api\AuthorController;
use App\Http\Controllers\api\BookController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', function () {
    return 'лололо! Работает!';
});

Route::post('/rating', RatingController::class);

Route::get('/search', SearchController::class);

Route::apiResources([
    '/authors' => AuthorController::class,
    '/books' => BookController::class,
]);

