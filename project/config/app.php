<?php

return [
    /**
     * --------------------------------------------
     * Authentication
     * --------------------------------------------
     */
    'auth' => [
        'table' => 'users',
        'guard' => 'username,password',
        'response' => [
            'fail' => '/login',
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
            'path' => 'storage',
        ],
        's3' => [
            'driver' => 's3',
            'path' => '',
        ],
    ],
];
