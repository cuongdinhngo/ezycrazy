<?php

return [
    '/export-users' => [
        ['get' => 'User/UserController@exportUsers'],
    ],
    '/users' => [
        'middleware' => ['first', 'second'],
        ['get' => 'User/UserController@list'],
        ['post' => 'User/UserController@create'],
        ['put' => 'User/UserController@put']
    ],
    '/user/action' => [
        ['get' => 'User/UserController@delete'],
        ['post' => 'User/UserController@update']
    ],
    '/user/create' => [
        ['get' => 'User/UserController@createForm'],
        ['post' => 'User/UserController@create']
    ],
    '/admin' => [
        ['get' => 'AdminController@admin'],
        ['post' => 'AdminController@signIn'],
    ]
];
