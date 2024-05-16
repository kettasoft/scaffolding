<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/select/countries', 'SelectController@countries')->name('countries.select');
Route::get('/select/cities', 'SelectController@cities')->name('cities.select');

Route::apiResource('countries', 'Api\CountryController')->only('index', 'show');
Route::get('country/default', 'Api\CountryController@default')->name('countries.default');

Route::get('cities/{country}', 'Api\CityController@index')->name('cities.index');
// Route::get('regions/{city}', 'Api\RegionController@index')->name('regions.index');

//Route::get('/get/countries', 'SelectController@getCountries')->name('countries.get');
//Route::get('/get/cities/{country}', 'SelectController@getCities')->name('cities.get');
