<?php

return [
    'routes' => [
        [
            'error_404' => [
                'name' => 'error_404',
                'url' => [
                    'hu' => '404-oldal-nem-talalhato',
                    'en' => '404-page-not-found',
                ],
                'module' => 'System', 'controller' => 'Error', 'action' => 'error404', 'view' => 'error404',
                'childrens' => []
            ],
        ],
        [
            'debug' => [
                'name' => 'debug',
                'url' => [
                    'hu' => 'hibakereses',
                    'en' => 'debug',
                ],
                'module' => 'System', 'controller' => 'Debug', 'action' => 'debuglist', 'view' => 'debuglist',
                'childrens' => [
                    'routes' => [
                        'name' => 'routes',
                        'url' =>  [
                            'hu' => 'linkek',
                            'en' => 'routes',
                        ],
                        'module' => 'System', 'controller' => 'Debug', 'action' => 'routes', 'view' => 'routes',
                        'childrens' => [
                        ]
                    ],
                ]
            ],
        ],
    ],
];
