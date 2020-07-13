<?php

return [
    'routes' => [
        [
          'login_page' =>  [
                'name' => 'login_page',
                'url' => array(
                    'hu' => 'bejelentkezes',
                    'en' => 'login',
                ),
                'module' => 'Authentication', 'controller' => 'Authentication', 'action' => 'login', 'view' => 'login',
                'childrens' => []
            ],
        'logout_page' => 
            [
                'name' => 'logout_page',
                'url' => array(
                    'hu' => 'kijelentkezes',
                    'en' => 'logout',
                ),
                'module' => 'Authentication', 'controller' => 'Authentication', 'action' => 'logout', 'view' => 'logout',
                'childrens' => []
            ],
        'register_page' => 
            [
                'name' => 'register_page',
                'url' =>  array(
                    'hu' => 'regisztracio',
                    'en' => 'registration',
                ),
                'module' => 'Authentication', 'controller' => 'Authentication', 'action' => 'registration', 'view' => 'registration',
                'childrens' => []
            ],
        ]
    ],
];