<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/','AutosController@index')
    ->name('auto.index')->middleware('auth');
Route::post('/','AutosController@store')
    ->name('auto.store')->middleware('auth');
Route::get('/autos/data-load','AutosController@dataLoad')
    ->name('auto.dataLoad')->middleware('auth');
Route::get('/autos/{auto}','AutosController@show')
    ->name('auto.show')->middleware('auth');
Route::put('/autos/{auto}','AutosController@update')
    ->name('auto.update')->middleware('auth');
Route::delete('/autos/{auto}','AutosController@destroy')
    ->name('auto.destroy')->middleware('auth');
Route::get('/go','GoController@index')
    ->name('go.index')->middleware('auth');
Route::get('/report','ReportsController@index')
    ->name('report.index')->middleware('auth');
Route::delete('/report/{report}','ReportsController@destroy')
    ->name('report.destroy')->middleware('auth');
Route::get('/report/data-load','ReportsController@dataLoad')
    ->name('report.dataLoad')->middleware('auth');
Route::post('/report','ReportsController@store')
    ->name('report.store')->middleware('auth');
Route::get('/report/ratio','ReportsController@ratio')
    ->name('report.ratio')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
