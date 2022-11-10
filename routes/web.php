<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;

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

//Route Hooks - Do not delete//
	Route::view('ventas', 'livewire.ventas.index')->middleware('auth');
	Route::view('partners', 'livewire.partners.index')->middleware('auth');
	Route::view('servicios', 'livewire.servicios.index')->middleware('auth');
	Route::view('vigencias', 'livewire.vigencias.index')->middleware('auth');
	//Route::get('ventas-excel', 'App\Http\Controllers\ExcelController@salesExcel')->name('ventas.excel')->middleware('auth');
	Route::resource('/ventas-excel', 'App\Http\Controllers\ExcelController')->names('ventas-excel');