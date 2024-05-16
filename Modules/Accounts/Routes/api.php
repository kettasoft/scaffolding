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
Route::get('/select/providers', 'SelectController@providers')->name('providers.select');
Route::get('/select/parents', 'SelectController@index')->name('parent.select');

Route::post('/register', 'Api\RegisterController@register')->name('user.register');
Route::post('/login', 'Api\LoginController@login')->name('user.login');

Route::post('/password/forget', 'Api\ResetPasswordController@forget')->name('user.password.forget');
Route::post('/password/code', 'Api\ResetPasswordController@code')->name('user.password.code');
Route::post('/password/reset', 'Api\ResetPasswordController@reset')->name('user.password.reset');

Route::post('verification/send', 'Api\VerificationController@send')->name('verification.send');
Route::post('verification/resend', 'Api\VerificationController@send')->name('verification.resend');
Route::post('verification/verify', 'Api\VerificationController@verify')->name('verification.verify');

Route::middleware('auth:sanctum')->group(
    function () {

        Route::get('profile', 'Api\ProfileController@show')->name('user.profile.show');
        Route::post('profile', 'Api\ProfileController@update')
            ->name('user.profile.update');

        Route::get('user/exist', 'Api\ProfileController@exist')->name('user.exist');
        Route::post('user/preferred-locale', 'Api\ProfileController@preferredLocale')->name('user.preferred.locale');

        Route::post('logout', 'Api\ProfileController@logout')->name('user.logout');

        Route::get('user/check', 'Api\ProfileController@check')->name('user.check');
    }
);
