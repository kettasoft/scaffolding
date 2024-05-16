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

Route::prefix('deploy')->group(function () {
    Route::post('github', 'DeployController@githubDeploy');

    Route::post('bitbucket', 'DeployController@bitbucketDeploy');
});
