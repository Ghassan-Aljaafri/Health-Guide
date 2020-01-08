<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/system', function () {
    return view('system.index');
})->middleware('auth');

Route::get('/home', function () {
    return redirect('/system');
})->name('home');

Route::resource('/system/user', 'UserController');

Route::resource('/system/recipe', 'RecipeController');

Route::resource('/system/healthy-food-location', 'HealthyFoodLocationController');


Auth::routes();
