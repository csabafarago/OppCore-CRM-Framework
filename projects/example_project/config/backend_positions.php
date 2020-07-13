<?php

//home url must be set
return [
    [
        'params' => ['lang' => 'hu', 'url' => '/admin_home'],
        'positions' => [
            'top' => [
//                [
//                    'module' => 'UserMessagesMenu',
//                    'controller' => 'UserMessagesMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'UserNotificationsMenu',
//                    'controller' => 'UserNotificationsMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'UserTasksMenu',
//                    'controller' => 'UserTasksMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
                [
                    'module' => 'Widget',
                    'controller' => 'UserProfileWidget',
                    'action' => 'index',
                    'view' => 'index',
                    'params' => '',
                    'permission' => 'default',
                ],
            ],
            'left_sidabar' => [
//                [
//                    'module' => 'UserPanel',
//                    'controller' => 'UserPanel',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'SearchFrom',
//                    'controller' => 'SearchFrom',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
                [
                    'module' => 'Widget',
                    'controller' => 'Navigation',
                    'action' => 'index',
                    'view' => 'index',
                    'params' => '',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
    [
        'params' => ['lang' => 'en', 'url' => '/admin_home'],
        'positions' => [
            'top' => [
//                [
//                    'module' => 'UserMessagesMenu',
//                    'controller' => 'UserMessagesMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'UserNotificationsMenu',
//                    'controller' => 'UserNotificationsMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'UserTasksMenu',
//                    'controller' => 'UserTasksMenu',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
                [
                    'module' => 'Widget',
                    'controller' => 'UserProfileWidget',
                    'action' => 'index',
                    'view' => 'index',
                    'style' => 'index',
                    'permission' => 'default',
                ],
            ],
            'left_sidabar' => [
//                [
//                    'module' => 'UserPanel',
//                    'controller' => 'UserPanel',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
//                [
//                    'module' => 'SearchFrom',
//                    'controller' => 'SearchFrom',
//                    'action' => 'index',
//                    'style' => 'index',
//                    'permission' => 'default',
//                ],
                [
                    'module' => 'Widget',
                    'controller' => 'Navigation',
                    'action' => 'index',
                    'view' => 'index',
                    'style' => 'index',
                    'permission' => 'default',
                ],
            ],
        ]
    ],
];

