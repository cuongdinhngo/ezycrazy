<?php

return [
    'workplace' => [
        'api' => [
            'list_all' => 'https://arbetsprov.trinax.se/api/v1/workplace',
        ],
        'header' => [
            "Authorization: bearer ".env('API_KEY'), "Accept: application/json"
        ]
    ],
    'year' => [
        'start' => date("Y") - 5,
        'end' => date("Y"),
    ],
    'timereport' => [
        'api' => [
            'list_all' => 'https://arbetsprov.trinax.se/api/v1/timereport',
            'create' => 'https://arbetsprov.trinax.se/api/v1/timereport',
        ],
        'header' => [
            "Authorization: bearer ".env('API_KEY'),
            "Accept: application/json"
        ],
        'header_request_json' => [
            "Authorization: bearer ".env('API_KEY'),
            "Accept: application/json", 
            "Content-Type: application/json",
        ]
    ],
];
