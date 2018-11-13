<?php

use Illuminate\Http\Request;

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
Route::group(["prefix" => "v1"],function (){
   Route::post("login",["uses" => "Auth\AuthController@login"]);
   Route::post("/registration",["uses" => "UserController@store"]);
   Route::group(["middleware" => "auth:api"],function (){
       Route::post("/profile",["uses" => "ProfileController@index"]);
       Route::resource("/accounts","AccountController")->only([
           "index",
           "store",
           "update",
           "destroy"
       ]);
   });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
