<?php

return [
    '/export-users' => [
        ['get' => 'User/UserController@exportUsers'],
    ],
    '/users' => [
        'middleware' => ['first', 'auth', 'second', 'phpToJs'],
        ['get' => 'User/UserController@list'],
        ['post' => 'User/UserController@create'],
        ['put' => 'User/UserController@put']
    ],
    '/users/add' => [
        'middleware' => ['signed.url'],
        ['get' => 'User/UserController@createForm'],
    ],
    '/user/action' => [
        ['get' => 'User/UserController@delete'],
        ['post' => 'User/UserController@update']
    ],
    '/user/create' => [
        ['get' => 'User/UserController@createForm'],
        ['post' => 'User/UserController@create']
    ],
    '/user/update/{id}' => [
        ['get' => 'User/UserController@updateForm'],
        ['post' => 'User/UserController@update']
    ],
    '/admin' => [
        ['get' => 'AdminController@admin'],
        ['post' => 'AdminController@signIn'],
    ],
    '/import-users' => [
        ['get' => 'User/UserController@importForm'],
        ['post' => 'User/UserController@importUsers'],
    ],
    '/timereport' => [
        ['get' => 'TimeReportController@createListForm'],
        ['post' => 'TimeReportController@search'],
    ],
    '/timereport/create' => [
        ['get' => 'TimeReportController@createForm'],
        ['post' => 'TimeReportController@create'],
    ],
    '/users/{uId}/skills/{sId}' => [
        ['get' => 'User/UserController@test'],
    ],
];
