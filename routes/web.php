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

/*
 * Landing page
 */
Route::get('/', function () {
    return view('welcome');
});

/*
 * Login, register and password reset
 */
Auth::routes();

/*
 * Dashboard
 */
Route::group(['prefix' => 'dashboard'], function() {
    Route::get('/inicio', 'HomeController@index')->name('dashboard.inicio');

    //TODO crear RoutinesController
    //Route::get('/rutinas', 'RoutinesController@index');
});


