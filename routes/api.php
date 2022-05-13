<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\UserController;

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
    'prefix' => '/auth',
    ['middleware' => 'throttle:20,5'] 
],function(){
    Route::post("/register",[RegisterController::class,'register']);
    Route::post("/login",[LoginController::class,'login']);
});

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('/user', [UserController::class,'user']);
    Route::get('/auth/logout', [LoginController::class,'logout']);
});

