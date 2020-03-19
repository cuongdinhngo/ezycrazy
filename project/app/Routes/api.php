<?php

return [
    '/export-users' => [
        ['get' => 'UserController@exportUsers'],
    ],
    '/users' => [
        'middleware' => ['first', 'second'],
        ['get' => 'UserController@list'],
        ['post' => 'UserController@create'],
        ['put' => 'UserController@put']
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