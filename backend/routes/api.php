<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user()->load(['permissions']);
});

Route::prefix('auth')->group(function (){
    Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
    Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
});
//todo make private
Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('events')->group(function (){
        Route::post('',[EventController::class,'create']);
        Route::get('',[EventController::class,'list']);
        Route::put('{event}',[EventController::class ,'update']);
        Route::get('{event}',[EventController::class ,'item']);
        Route::delete('{event}',[EventController::class ,'destroy']);
        Route::put('{event}/subscribe',[EventController::class,'subscribe']);
        Route::put('{event}/unsubscribe',[EventController::class,'unsubscribe']);
    });
    Route::prefix('users')->group(function (){
        Route::get('',[\App\Http\Controllers\UserController::class,'list']);
    });
});
