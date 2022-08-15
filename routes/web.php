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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/lecturer/import', 'LecturerController@import')->name('lecturer.import');
Route::resource('lecturer', 'LecturerController');


Route::post('/session/import', 'SessionController@import')->name('session.import');
Route::resource('session', 'SessionController');

Route::post('/readiness/add/{lecturer_id}', 'ReadinessController@add')->name('readiness.add');
Route::resource('readiness', 'ReadinessController');
