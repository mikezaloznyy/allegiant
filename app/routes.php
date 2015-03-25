<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::resource('customers', 'CustomersController');
Route::get('customers', 'CustomersController@index');
Route::get('customers/{page}', 'CustomersController@index');
Route::get('customer/{id}', 'CustomersController@show');
Route::delete('customer/{id}', 'CustomersController@destroy');
Route::post('customers', 'CustomersController@store');
Route::put('customers/{id}', 'CustomersController@update');
Route::post('search', 'CustomersController@search');