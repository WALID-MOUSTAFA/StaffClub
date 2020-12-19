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



Route::get("/polls/", "App\Http\Controllers\MemberPollController@index")
        ->middleware("checkMemberLogin");


Route::get("/polls/{id}", "App\Http\Controllers\MemberPollController@takePoll")
        ->middleware("checkMemberLogin");


Route::post("/polls/save-answers/", "App\Http\Controllers\MemberPollController@saveAnswers")
        ->middleware("checkMemberLogin");







//TODO(walid): change get to post in production;
Route::get("/logout", "App\Http\Controllers\LoginController@logout")
        ->middleware("checkMemberLogin");


Route::get("/admin/mods/login", "App\Http\Controllers\ModsController@getLogin")
        ->middleware("checkMemberLogin");


Route::post("/admin/mods", "App\Http\Controllers\ModsController@allMods")
        ->middleware("checkMemberLogin");


Route::get("/admin/mods/edit/{id}", "App\Http\Controllers\ModsController@getEditMod")
        ->middleware("checkMemberLogin");

Route::post("/admin/mods/edit/{id}", "App\Http\Controllers\ModsController@postEditMod")
        ->middleware("checkMemberLogin");


Route::post("/admin/mods/delete/{id}", "App\Http\Controllers\ModsController@postDeleteMod")
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



Route::get("/admin/polls",
           "App\Http\Controllers\PollController@index")
        ->middleware("checkMemberLogin");



Route::get("/admin/polls/add",
           "App\Http\Controllers\PollController@getAddSinglePoll")
        ->middleware("checkMemberLogin");


Route::post("/admin/polls/add",
           "App\Http\Controllers\PollController@postAddSinglePoll")
        ->middleware("checkMemberLogin");




Route::get("/admin/polls/{id}",
           "App\Http\Controllers\PollController@viewSinglePoll")
        ->middleware("checkMemberLogin");



Route::get("/admin/polls/edit/{id}",
           "App\Http\Controllers\PollController@getEditSinglePoll")
        ->middleware("checkMemberLogin");



Route::post("/admin/polls/edit/{id}",
           "App\Http\Controllers\PollController@postEditSinglePoll")
        ->middleware("checkMemberLogin");

Route::post("/admin/polls/delete/{id}",
           "App\Http\Controllers\PollController@postDeleteSinglePoll")
        ->middleware("checkMemberLogin");


Route::get("/admin/polls/{id}/add-question",
           "App\Http\Controllers\PollController@getAddQuestion")
        ->middleware("checkMemberLogin");


Route::post("/admin/polls/{id}/add-question",
           "App\Http\Controllers\PollController@postAddQuestion")
        ->middleware("checkMemberLogin");



Route::get("/admin/questions/edit/{id}",
           "App\Http\Controllers\PollController@getEditQuestion")
        ->middleware("checkMemberLogin");

Route::post("/admin/questions/edit/{id}",
           "App\Http\Controllers\PollController@postEditQuestion")
        ->middleware("checkMemberLogin");


Route::post("/admin/questions/delete/{id}",
           "App\Http\Controllers\PollController@postDeleteQuestion")
        ->middleware("checkMemberLogin");












