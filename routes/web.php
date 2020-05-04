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
Route::get('/autos/data-load','AutosController@dataLoad')->name('auto.dataLoad');
Route::get('/autos/{auto}','AutosController@show')->name('auto.show');
Route::put('/autos/{auto}','AutosController@update')->name('auto.update');
Route::delete('/autos/{auto}','AutosController@destroy')->name('auto.destroy');
Route::post('/','AutosController@store')->name('auto.store');
Route::get('/go','GoController@index')->name('go.index');
Route::get('/report','ReportsController@index')->name('report.index');
Route::get('/report/data-load','ReportsController@dataLoad')->name('report.dataLoad');
Route::post('/report','ReportsController@store')->name('report.store');
Route::get('/report/ratio','ReportsController@ratio')->name('report.ratio');
