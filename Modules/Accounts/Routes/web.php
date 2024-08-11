<?php

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

Route::middleware('dashboard')
    ->prefix('dashboard')
    ->as('dashboard.')
    ->group(
        function () {
            Route::prefix('accounts')
                ->group(
                    function () {
                        Route::resource('admins', 'Dashboard\AdminController');

                        // block routes
                        Route::patch('admins/{admin}/block', 'Dashboard\AdminController@block')->name('admins.block');
                        Route::patch('admins/{admin}/unblock', 'Dashboard\AdminController@unblock')->name('admins.unblock');
                    }
                );
        }
    );
