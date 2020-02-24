<?php

return [
    /**
     * --------------------------------------------
     * Authentication
     * --------------------------------------------
     */
    'auth' => [
        'table' => 'users',
        'guard' => 'email,password',
        'response' => [
            'fail' => '/admin',
            'error' => 'Please try again!',
            'success' => '/users'
        ],
    ],

    /**
     * --------------------------------------------
     * Storage Configuration
     * --------------------------------------------
     */
    'storage' => [
        'local' => [
            'driver' => 'local',
            'path' => 'public',
        ],
        's3' => [
            'driver' => 's3',
            'path' => '',
        ],
    ],
];
