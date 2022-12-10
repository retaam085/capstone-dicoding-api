<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
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

Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);

Route::group(['middleware' => 'auth.role:admin,user','prefix' => 'auth'], function ($router) {
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);
});

Route::group(['middleware' => 'auth.role:admin,user','prefix' => 'news'], function ($router) {
    Route::post('/create', [NewsController::class,'create']);
    Route::get('/getAllNews', [NewsController::class,'showAll']);
    Route::get('/delete/{id}', [NewsController::class,'delete']);
    Route::get('/show/{id}', [NewsController::class,'showById']);
    Route::post('/update/{id}',[NewsController::class,'update']);
});
