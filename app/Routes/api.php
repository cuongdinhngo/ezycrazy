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
    ],
    '/accounts' => [
        ['get' => 'Account/AccountController@list'],
        ['post' => 'Account/AccountController@create'],
        ['put' => 'Account/AccountController@update'],
    ],
    '/accounts/action' => [
        ['post' => 'Account/AccountController@update'],
        ['get' => 'Account/AccountController@delete'],
    ],
    '/products' => [
        ['post' => 'Product/ProductController@create'],
        ['get' => 'Product/ProductController@list'],
    ],
    '/products/action' => [
        ['post' => 'Product/ProductController@update'],
        ['get' => 'Product/ProductController@delete'],
    ],
    '/graphql-sample' => [
        ['get' => 'GraphQLSample/GraphQLSampleController@sayHello'],
    ],
    '/graphql-shorthand-greeting' => [
        ['get' => 'GraphQLSample/GraphQLSampleController@shorthandGreeting'],
    ],
    '/graphql-shorthand-calc' => [
        ['get' => 'GraphQLSample/GraphQLSampleController@shorthandCalc'],
    ],
    '/graphql-list-users' => [
        ['get' => 'GraphQLSample/GraphQLUserController@list'],
        ['post' => 'GraphQLSample/GraphQLUserController@list'],
    ],
    '/graphql-list-users-shorthand' => [
        ['get' => 'GraphQLSample/GraphQLUserController@shorthandList'],
    ],
    '/graphql-show-user-shorthand' => [
        ['get' => 'GraphQLSample/GraphQLUserController@shorthandShow'],
    ],
    '/graphql-create-user' => [
        ['post' => 'GraphQLSample/GraphQLUserController@create'],
    ],
];
