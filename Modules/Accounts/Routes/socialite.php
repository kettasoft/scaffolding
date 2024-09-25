<?php

use Illuminate\Support\Facades\Route;
use Modules\Accounts\Http\Controllers\Socialite\SetSocialiteDriverController;
use Modules\Accounts\Http\Controllers\Socialite\Drivers\GoogleSocialiteController;

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

Route::middleware('guest')->prefix('oAuth')->as('login.')->group(function (): void {
  Route::get('{driver}', SetSocialiteDriverController::class)->name('socialite');

  Route::get('google/callback', [GoogleSocialiteController::class, 'callback'])->name('google.callback');
});
