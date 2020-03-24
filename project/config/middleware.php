<?php

return [
    /**
     * The application's route middlewares
     */
    'routeMiddlewares' => [
        'first' => 'FirstMiddleware',
        'second' => 'SecondMiddleware',
        'auth' => 'Authorization',
        'phpToJs' => 'PhpToJs',
    ],

    /**
     * List of priority middlewares
     */
    'priorityMiddlewares' => [
        'auth' => 'Authorization',
        'phpToJs' => 'PhpToJs',
    ],
];