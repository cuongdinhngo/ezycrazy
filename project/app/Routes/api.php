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
    '/admin' => [
    	['get' => 'AdminController@admin'],
        ['post' => 'AdminController@signIn'],
    ]
];