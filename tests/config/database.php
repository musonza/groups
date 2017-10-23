<?php

return [

    //...

    'default' => env('DB_CONNECTION', 'mysql'),

    //...

    'connections' => [

        'mysql' => [
            'driver'    => 'mysql',
            'host'      => env('DB_HOST', 'localhost'),
            'database'  => env('DB_DATABASE', 'homestead'),
            'username'  => env('DB_USERNAME', 'homestead'),
            'password'  => env('DB_PASSWORD', 'secret'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

        'testing' => [
            'driver'    => 'mysql',
            'host'      => env('DB_TEST_HOST', 'localhost'),
            'database'  => env('DB_TEST_DATABASE', 'homestead_test'),
            'username'  => env('DB_TEST_USERNAME', 'homestead'),
            'password'  => env('DB_TEST_PASSWORD', 'secret'),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ],

    ],

    //...

];