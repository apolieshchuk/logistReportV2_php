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

Route::get('/','AutosController@index')->name('auto.index');
Route::get('/data-load','AutosController@dataLoad')->name('auto.dataLoad');
Route::get('/go','GoController@index')->name('go.index');
Route::get('/report','ReportsController@index')->name('report.index');
Route::get('/report/data-load','ReportsController@dataLoad')->name('report.dataLoad');
