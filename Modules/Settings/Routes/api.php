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
Route::get('show-settings', 'Api\SettingController@index')->name('settings.index');
//Route::get('show-privacy-policy', 'Api\SettingController@privacy')->name('settings.privacy');
//Route::get('show-terms-conditions', 'Api\SettingController@terms')->name('settings.terms');
Route::get('show-contacts', 'Api\SettingController@contacts')->name('settings.contacts');
