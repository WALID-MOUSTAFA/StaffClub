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


//TODO(walid): separate member into it's own controller;
//TODO(walid): separate familyrelative into it's own controller;


Route::get("/login", "App\Http\Controllers\LoginController@getLogin");

Route::post("/login", "App\Http\Controllers\LoginController@postLogin");

Route::get("/profile", "App\Http\Controllers\ProfileController@getProfile")
        ->middleware("checkMemberLogin");

Route::post("/edit-member/{id}",
            "App\Http\Controllers\MemberController@editMember" )
                ->middleware("checkMemberLogin");


Route::post("/add-relative",
            "App\Http\Controllers\FamilyRelativeController@addRelative")
        ->middleware("checkMemberLogin");

Route::post("/edit-relative/{id}",
            "App\Http\Controllers\FamilyRelativeController@editRelative")
        ->middleware("checkMemberLogin");

Route::post("/delete-relative/{id}",
            "App\Http\Controllers\FamilyRelativeController@deleteRelative")
        ->middleware("checkMemberLogin");



//TODO(walid): change get to post in production;
Route::get("/logout", "App\Http\Controllers\LoginController@logout")
        ->middleware("checkMemberLogin");

Route::get("/admin", "App\Http\Controllers\AdminController@index")
        ->middleware("checkMemberLogin");

Route::get("/admin/members", "App\Http\Controllers\AdminController@viewMembers")
        ->middleware("checkMemberLogin");

Route::get("/admin/members/{id}", "App\Http\Controllers\AdminController@viewSingleMember")
        ->middleware("checkMemberLogin");

Route::get("/admin/members/edit/{id}",
           "App\Http\Controllers\AdminController@getEditSingleMember")
        ->middleware("checkMemberLogin");


Route::post("/admin/members/edit/{id}",
           "App\Http\Controllers\AdminController@postEditSingleMember")
        ->middleware("checkMemberLogin");

Route::post("/admin/members/edit-relative/{id}",
           "App\Http\Controllers\AdminController@editRelative")
        ->middleware("checkMemberLogin");



