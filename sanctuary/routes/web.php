<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;

//creates animals routes
Route::resource('animals',AnimalController::class);
use App\Http\Controllers\AdoptionController; 


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

//sets home page to home.blade.php
Route::get('/', function () {
    return view('home');
});

//authorised users
Auth::routes();

//makeAdoption request route
Route::get('/make_adoption/{animalid}', 'App\Http\Controllers\AdoptionController@makeAdoption');

//denyAdoption request route
Route::get('/denied_adoption/{id}', 'App\Http\Controllers\AdoptionController@denyAdoption');

//approveAdoption request route
Route::get('/accepted_adoption/{id}', 'App\Http\Controllers\AdoptionController@approveAdoption');

//show all Adoption Requests route
Route::get('adoptions/all', 'App\Http\Controllers\AdoptionController@showAllRequests');

//creates adoptions routes
Route::resource('adoptions',AdoptionController::class);
    Route::get('adoptions', 'App\Http\Controllers\AdoptionController@index');
