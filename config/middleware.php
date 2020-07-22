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
        'signed.url' => 'IdentifySignedUrl',
    ],

    /**
     * List of priority middlewares
     */
    'priorityMiddlewares' => [
        'auth' => 'Authorization',
        'signed.url' => 'IdentifySignedUrl',
        'phpToJs' => 'PhpToJs',
    ],
];