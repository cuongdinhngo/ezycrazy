<?php

return [
    '/export-users' => [
        ['get' => 'UserController@exportUsers'],
    ],
    '/users' => [
        ['get' => 'UserController@list'],
        ['post' => 'UserController@create']
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
];