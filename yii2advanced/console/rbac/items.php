<?php
return [
    'view_form' => [
        'type' => 2,
        'description' => 'view_form',
    ],
    'view_chart' => [
        'type' => 2,
        'description' => 'view_chart',
    ],
    'User' => [
        'type' => 1,
        'children' => [
            'view_form',
        ],
    ],
    'Admin' => [
        'type' => 1,
        'children' => [
            'User',
        ],
    ],
];
