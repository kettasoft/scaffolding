<?php

Route::get('/select/articles', 'SelectController@articles')->name('articles.select');

Route::apiResource('articles', 'Api\ArticleController')->only('index', 'show');
