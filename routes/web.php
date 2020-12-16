<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/login", "App\Http\Controllers\LoginController@getLogin");

Route::post("/login", "App\Http\Controllers\LoginController@postLogin");

Route::get("/profile", "App\Http\Controllers\ProfileController@getProfile")
        ->middleware("checkMemberLogin");

Route::post("/edit-member/{id}", "App\Http\Controllers\ProfileController@editMember" )
                ->middleware("checkMemberLogin");


Route::post("/add-relative", "App\Http\Controllers\ProfileController@addRelative")
        ->middleware("checkMemberLogin");


//TODO(walid): make a logout route;
