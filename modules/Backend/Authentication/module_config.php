<?php

return [
    'routes' => [
        'name' => 'login_page',
        'url' => [
            'hu' => 'bejelentkezes',
            'en' => 'login',
        ],
        'module' => 'Authentication', 'controller' => 'Authentication', 'action' => 'login', 'view' => 'login',
        'childrens' => []
    ],
];