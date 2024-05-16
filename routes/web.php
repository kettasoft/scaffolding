<?php

use Illuminate\Support\Facades\Route;
use Modules\Children\Entities\Child;
use Modules\Children\Jobs\SonQueueJob;

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

Route::get('/test', function () {
    $child = Child::first()->toArray();
    SonQueueJob::dispatch(array_merge($child, ['iterations' => 1]));
});

Auth::routes();

Route::middleware('dashboard.locales')->group(function () {
    Auth::routes();
});

Route::impersonate();
