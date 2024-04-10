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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
	
	
	Route::resource('roles', App\Http\Controllers\RolController::class);
	Route::resource('users', App\Http\Controllers\UserController::class);
	Route::resource('empresas', App\Http\Controllers\EmpresaController::class);
	Route::resource('encuestas', App\Http\Controllers\EncuestaController::class);
	Route::resource('reportes', App\Http\Controllers\ReporteController::class);

	//Exportaciones de excel
	Route::get('encuesta.export', 'App\Http\Controllers\EncuestaController@export')->name('encuesta.export');
	Route::get('reporte.export', 'App\Http\Controllers\ReporteController@export')->name('reporte.export');

	//Exportaciones PDF
	Route::get('encuesta.pdf', 'App\Http\Controllers\EncuestaController@pdf')->name('encuesta.pdf');
	Route::get('reporte.pdf', 'App\Http\Controllers\ReporteController@pdf')->name('reporte.pdf');
});

