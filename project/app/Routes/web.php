<?php

return [
    '/export-users' => [
        ['get' => 'UserController@exportUsers'],
    ],
    '/users' => [
        'middleware' => ['first', 'second', 'auth', 'phpToJs'],
        ['get' => 'User/UserController@list'],
        ['post' => 'User/UserController@create'],
        ['put' => 'User/UserController@put']
    ],
    '/user/action' => [
        ['get' => 'UserController@delete'],
        ['post' => 'UserController@update']
    ],
    '/user/create' => [
        ['get' => 'UserController@createForm'],
        ['post' => 'UserController@create']
    ],
    '/user/update' => [
        ['get' => 'UserController@updateForm'],
        ['post' => 'UserController@update']
    ],
    '/admin' => [
    	['get' => 'AdminController@admin'],
        ['post' => 'AdminController@signIn'],
    ],
    '/import-users' => [
        ['get' => 'UserController@importForm'],
        ['post' => 'UserController@importUsers'],
    ],
    '/timereport' => [
        ['get' => 'TimeReportController@createListForm'],
        ['post' => 'TimeReportController@search'],
    ],
    '/timereport/create' => [
        ['get' => 'TimeReportController@createForm'],
        ['post' => 'TimeReportController@create'],
    ],
];