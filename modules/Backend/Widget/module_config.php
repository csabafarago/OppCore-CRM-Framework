<?php
//ez routes azért kell hogy ne rinyáljon a kibaszott route generátor /hibakereses/
return [
    'routes' => [
        'name' => 'dummy_route',
        'url' => [
            'hu' => 'dummy_route',
            'en' => 'dummy_route',
        ],
        'module' => 'dummy_route', 'controller' => 'dummy_route', 'action' => 'dummy_route', 'view' => 'dummy_route',
        'childrens' => []
    ],
    'controllers' => [
        'Navigation'=>'{"name":"Navigation","action":"index","controller":"Navigation","bundle":"BackendSubmodules"}',
        'UserMessagesMenu'=>'{"name":"UserMessagesMenu","action":"index","controller":"UserMessagesMenu","bundle":"BackendSubmodules"}',
        'UserNotificationsMenu'=>'{"name":"UserNotificationsMenu","action":"index","controller":"UserNotificationsMenu","bundle":"BackendSubmodules"}',
        'UserPanel'=>'{"name":"UserPanel","action":"index","controller":"UserPanel","bundle":"BackendSubmodules"}',
        'UserProfileWidget'=>'{"name":"UserProfileWidget","action":"index","controller":"UserProfileWidget","bundle":"BackendSubmodules"}',
        'UserTasksMenu'=>'{"name":"UserTasksMenu","action":"index","controller":"UserTasksMenu","bundle":"BackendSubmodules", "url":true}',
    ]
];