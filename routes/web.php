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
 * Blog
 */
Route::get('/blog/posts/{post}', 'PostController@showBlogPost')->name('blog.post.show');

/**
 * Login, register and password reset
 */
//Auth::routes();
// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

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
    Route::get('/clientes/crear', 'ClientsController@showNewClientForm')->name('dashboard.client.create');
    Route::get('/clientes/{client}', 'ClientsController@showClient')->name('dashboard.client');

    Route::get('/instructores/crear', 'InstructorsController@showNewInstructorForm')->name('dashboard.instructor.create');
    Route::get('/instructores', 'InstructorsController@showInstructors')->name('dashboard.instructors');
    Route::get('/instructores/{instructor}', 'InstructorsController@showInstructor')->name('dashboard.admin.instructor');

    Route::get('/servicios', 'ServicesController@showServices')->name('dashboard.services');
    Route::get('/servicios/crear', 'ServicesController@showNewServiceForm')->name('dashboard.service.create');
    Route::get('/servicios/{service}', 'ServicesController@showService')->name('dashboard.service');

    Route::get('/facturas/crear', 'InvoicesController@showNewInvoiceForm')->name('dashboard.invoice.create');
    Route::get('/facturas', 'InvoicesController@showInvoices')->name('dashboard.invoices');
    Route::get('/facturas/{invoice}', 'InvoicesController@showInvoice')->name('dashboard.invoice');
});

//Rutas accesibles por el CLIENTE y ADMINISTRADOR

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:client,admin'], function() {
    Route::get('/facturas/{invoice}/pdf', 'InvoicesController@invoiceToPdf')->name('dashboard.invoice.pdf');
});

//Rutas accesibles solo por el CLIENTE
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:client'], function() {
    Route::get('/instructor', 'ClientsController@showInstructorOfClient')
        ->name('dashboard.instructor');
    Route::get('/facturacion', 'InvoicesController@showInvoicesOfClient')
        ->name('dashboard.client.invoices');

    Route::get('/rutina', 'ExerciseController@showRoutineOfClient')->name('dashboard.routines');
});

//Rutas accesibles solo por el INSTRUCTOR
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:instructor'], function() {
    Route::get('/clientes_instruidos/{client}/rutina', 'ExerciseController@exercisesOfClient')->name('dashboard.exercisesOfClient');
    Route::get('/clientes_instruidos', 'InstructorsController@showInstructorClients')->name('dashboard.show.instructorClients');
});

//Rutas accesibles por el ADMINISTRADOR e INSTRUCTOR
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:admin,instructor'], function() {
    Route::get('/noticias/crear', 'PostController@create')->name('dashboard.posts.create');
    Route::get('/noticias/{post}', 'PostController@show')->name('dashboard.posts.show');
    Route::get('/noticias', 'PostController@allPosts')->name('dashboard.posts');
});

//Rutas accesibles por TODOS los usuarios autenticados
Route::group(['prefix' => 'dashboard', 'middleware' => 'auth:client,instructor,admin'], function() {
    Route::get('/inicio', 'HomeController@index')->name('dashboard.start');


    Route::get('/clientes/{client}/chat', 'MessageController@showChatWithClient')->name('dashboard.chatWithClient');
    Route::get('/instructores/{instructor}/chat', 'MessageController@showChatWithInstructor')->name('dashboard.chatWithInstructor');
    Route::get('/administradores/{administrator}/chat', 'MessageController@showChatWithAdmin')->name('dashboard.chatWithAdmin');

    Route::get('/admins', 'AdministratorController@allAdmins')->name('dashboard.admins');

    /*
    Route::get('/dietas', function(){
        return view('sections.diets');
    })->name('dashboard.diets');

    Route::get('/progreso', function(){
        return view('sections.progress');
    })->name('dashboard.progress');



    Route::get('/ajustes', function(){
        return view('sections.settings');
    })->name('dashboard.settings');
    */
    Route::get('/horario', function(){
        return view('sections.schedule');
    })->name('dashboard.schedule');
    Route::get('/perfil', 'ProfileController@showProfile')->name('dashboard.profile');
});

/**
 * API
 */
Route::group(['prefix' => '/api'], function () {
    /*
     * Exercises
     */
    Route::delete('/exercises/{exercise}', 'ExerciseController@delete')->middleware('auth:instructor')->name('exercise.delete');
    Route::put('/exercises/{exercise}', 'ExerciseController@check')->middleware('auth:client')->name('exercise.check');
    Route::post('/exercises', 'ExerciseController@store')->middleware('auth:instructor')->name('exercise.store');

    /**
     * Notifications
     */
    Route::get('/notifications', 'NotificationsController@unread')->middleware('auth:admin,client,instructor');
    Route::get('/notifications/all', 'NotificationsController@all')->middleware('auth:admin,client,instructor');
    Route::put('/notifications/{notification}/read', 'NotificationsController@markAsRead')->middleware('auth:admin,client,instructor');
    Route::delete('/notifications/all', 'NotificationsController@deleteAll')->middleware('auth:admin,client,instructor');
   /**
    * Instructors
    */
   Route::get('/instructors', 'InstructorsController@index')->middleware('auth:admin');
   Route::get('/instructors/{instructor}', 'InstructorsController@show')->middleware('auth:admin,instructor');
   Route::get('/instructors/{instructor}/clients', 'InstructorsController@showClientsInstructedBy')->middleware('auth:admin');
   Route::post('/instructors', 'InstructorsController@store')->name('instructor.store')->middleware('auth:admin');
   Route::delete('/instructors/{instructor}', 'InstructorsController@destroy')->middleware('auth:admin');
   Route::put('/instructors/{instructor}', 'InstructorsController@update')->middleware('auth:admin');
   Route::put('/instructors/{instructor}/schedule', 'InstructorsController@updateSchedule')->middleware('auth:admin');

   /**
    * Clients
    */
   Route::get('/clients', 'ClientsController@index')->middleware('auth:admin');
   Route::get('/clients/{client}', 'ClientsController@show')->middleware('auth:admin,client');
   Route::delete('/clients/{client}', 'ClientsController@destroy')->middleware('auth:admin');
   Route::put('/clients/{client}', 'ClientsController@update')->middleware('auth:admin');
   Route::post('/clients', 'ClientsController@store')->name('client.store')->middleware('auth:admin');

   /**
    * Services
    */
   Route::get('/services', 'ServicesController@index')->name('services.index')->middleware('auth:admin');
   Route::get('/services/{service}', 'ServicesController@show')->name('services.show')->middleware('auth:admin');
   Route::put('/services/{service}', 'ServicesController@update')->name('services.update')->middleware('auth:admin');
   Route::delete('/services/{service}', 'ServicesController@destroy')->name('services.destroy')->middleware('auth:admin');
   Route::post('/services', 'ServicesController@store')->name('services.store')->middleware('auth:admin');

   /**
    * Invoices
    */
   Route::get('/invoices_services', 'InvoicesController@invoicesWithServices')->name('invoices.withServices')->middleware('auth:admin');
   Route::get('/invoices', 'InvoicesController@index')->name('invoices.index')->middleware('auth:admin');
   Route::get('/invoices/{invoice}', 'InvoicesController@show')->middleware('auth:admin');
   Route::post('/invoices', 'InvoicesController@store')->name('invoices.store')->middleware('auth:admin');
   Route::put('/invoices/{invoice}', 'InvoicesController@update')->name('invoices.update')->middleware('auth:admin');

   /**
    * Administrators
    */
   Route::get('/administrators/{administrator}', 'AdministratorController@show')->name('admin.show')->middleware('auth:admin');
   Route::put('/administrators/{administrator}', 'ProfileController@updateAdmin')->name('admin.update')->middleware('auth:admin');
   Route::delete('/administrators/{administrator}', 'AdministratorController@delete')->name('admin.delete')->middleware('auth:admin');

   /**
    * Profile_picture
    */
   Route::post('/profile_picture', 'ProfileController@updatePP')->middleware('auth:admin,client,instructor');
   Route::delete('/profile_picture', 'ProfileController@deletePP')->middleware('auth:admin,client,instructor');

    /**
     * Profile
     */
    Route::put('/administrators/{administrator}', 'ProfileController@updateAdmin')->name('admin.update')->middleware('auth:admin');
    Route::put('/profile/clients/{client}', 'ProfileController@updateClient')->name('client.profile.update')->middleware('auth:client');
    Route::put('/profile/instructors/{instructor}', 'ProfileController@updateInstructor')->name('instructor.profile.update')->middleware('auth:instructor');

   /**
    * Posts
    */
   Route::get('/posts', 'PostController@index');
   Route::post('/posts', 'PostController@store')->name('posts.store')->middleware('auth:admin,instructor');
   Route::put('/posts/{post}', 'PostController@update')->name('posts.update')->middleware('auth:admin,instructor');
   Route::delete('/posts/{post}', 'PostController@delete')->name('posts.delete')->middleware('auth:admin,instructor');

   /**
    * Messages
    */
   Route::post('/clientes/{client}/chat', 'MessageController@messageToClient')->name('message.toClient')->middleware('auth:admin,instructor');
   Route::post('/instructores/{instructor}/chat', 'MessageController@messageToInstructor')->name('message.toInstructor')->middleware('auth:admin,client');
   Route::post('/administradores/{administrator}/chat', 'MessageController@messageToAdministrator')->name('message.toAdministrator')->middleware('auth:admin,instructor,client');

});

