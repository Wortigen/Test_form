<?php

return [
    'css' => [
        'css/bootstrap.min.css',
        'css/main.css'
    ],
    'js' => [
//        'js/bootstrap.min.js',
//        'js/bootstrap.bundle.min.js',
        'js/jquery.js',
        'js/main.js',
    ],
    'resources' => [
        'fileSave' => [
            'path' => '/resources',
            'table' => '/table',
            'savePath' => '/member',
            'exist' => 'always',
        ],
    ],
    'log' => [
        'path' => '/log',
        'default' => 'def.log',
        'type' => 'txt',
    ],
    'dLayout' => 'layout',
    'pathView' => '/core/view/',
    'requirements' => [
        'PHP' => '7.1',
        'MySql' => '5.6',
    ],
    'error' => [
        'default' => 'error',
        '404' => '404',
    ]
];