<?php

    return [
        'id' => [
            'type' => 'int',
            'value' => '++',
            'require' => true,
        ],
        'name' => [
            'type' => 'string',
            'max' => 255,
            'require' => true,
        ],
        'mail' => [
            'type' => 'string',
            'validate' => 'mail',
            'require' => true,
            'uniquer' => true,
        ],
        'password' => [
            'type' => 'string',
            'max' => 80,
        ],
    ];

?>