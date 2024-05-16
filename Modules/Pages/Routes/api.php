<?php

Route::get('/select/pages', 'SelectController@pages')->name('pages.select');

Route::apiResource('pages', 'Api\PageController')->only('index', 'show');
