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

Route::middleware('auth')->group(function () {

    Route::get('/','AutosController@index')->name('auto.index');

    Route::post('/','AutosController@store')->name('auto.store');

    Route::get('/autos/data-load','AutosController@dataLoad')->name('auto.dataLoad');

    Route::get('/autos/{auto}','AutosController@show')->name('auto.show');

    Route::put('/autos/{auto}','AutosController@update')->name('auto.update');

    Route::delete('/autos/{auto}','AutosController@destroy')->name('auto.destroy');

    Route::get('/go','GoController@index')->name('go.index');

    Route::post('/go', 'GoController@store')->name('go.store');

    Route::prefix('report')->group(function(){

        Route::get('data-load','ReportsController@dataLoad')->name('report.dataLoad');

        Route::get('ratio','ReportsController@ratio')->name('report.ratio');

    });

    Route::get('report','ReportsController@index')->name('report.index');

    Route::post('report','ReportsController@store')->name('report.store');

    Route::delete('report/{report}','ReportsController@destroy')->name('report.destroy');

    Route::put('report/{report}','ReportsController@update')->name('report.update');

    Route::get('report/{report}','ReportsController@show')->name('report.show');

    Route::get('bills','BillsController@index')->name('bills.index');

});

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
