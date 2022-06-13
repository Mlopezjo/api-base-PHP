<?php

use Router\Router;

Router::post('/login', 'Auth\Controllers\AccountController@login');
Router::post('/register', 'Auth\Controllers\AccountController@register');

// Router::get('/posts', 'App\Controllers\BlogController@index');
// Router::get('/post/:id', 'App\Controllers\BlogController@show');
// Router::get('/api', 'App\Controllers\BlogController@api');