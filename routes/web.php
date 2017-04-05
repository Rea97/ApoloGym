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
    Route::get('/rutinas', function(){
        return view('sections.routines');
    })->name('dashboard.routines');

    Route::get('/dietas', function(){
        return view('sections.diets');
    })->name('dashboard.diets');

    Route::get('/progreso', function(){
        return view('sections.progress');
    })->name('dashboard.progress');

    Route::get('/horario', function(){
        return view('sections.schedule');
    })->name('dashboard.schedule');

    Route::get('/instructor', function(){
        return view('sections.instructor');
    })->name('dashboard.instructor');

    Route::get('/perfil', function(){
        return view('sections.profile');
    })->name('dashboard.profile');

    Route::get('/ajustes', function(){
        return view('sections.settings');
    })->name('dashboard.settings');
});


