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

/**
 * Login, register and password reset
 */
Auth::routes();

/**
 * Administrator login
 */
Route::group([
    'namespace' => '\Auth',
    'prefix' => 'admin',
    'middleware' => 'guest:admin,client,instructor'
], function() {
    Route::get('/login', 'AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login.post');
    Route::post('/logout', 'AdminLoginController@logout')->name('admin.logout');
});

/**
 * Dashboard
 */

//Rutas accesibles solo por el ADMINISTRADOR
Route::group(['prefix' => 'dashboard','middleware' => 'auth:admin'], function() {
    Route::get('/clientes', 'ClientsController@showClients')->name('dashboard.clients');
    Route::get('/clientes/{client}', 'ClientsController@showClient')->name('dashboard.client');
    Route::get('/instructores', 'InstructorsController@showInstructors')->name('dashboard.instructors');
});

//Rutas accesibles solo por el CLIENTE
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:client'], function() {
    Route::get('/instructor', 'InstructorsController@showClientsInstructor')
        ->name('dashboard.instructor');
});

//Rutas accesibles por TODOS los usuarios autenticados
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:client,instructor,admin'], function() {
    Route::get('/inicio', 'HomeController@index')->name('dashboard.start');

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

    Route::get('/perfil', function(){
        return view('sections.profile');
    })->name('dashboard.profile');

    Route::get('/ajustes', function(){
        return view('sections.settings');
    })->name('dashboard.settings');
});

/**
 * API
 */
Route::group(['prefix' => '/api'], function () {
   /**
    * Instructors
    */
   Route::get('/instructors', 'InstructorsController@index')->middleware('auth:admin');

   /**
    * Clients
    */
   Route::get('/clients', 'ClientsController@index')->middleware('auth:admin');
   Route::get('/clients/{client}', 'ClientsController@show')->middleware('auth:admin');
   Route::delete('/clients/{client}', 'ClientsController@destroy')->middleware('auth:admin');
   Route::put('/clients/{client}', 'ClientsController@update')->middleware('auth:admin');
});

