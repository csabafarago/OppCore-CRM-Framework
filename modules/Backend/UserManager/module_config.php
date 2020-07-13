<?php

return [
    'routes' => [
        'name' => 'user_controlpanel',
        'type' => 'literal',
        'validate' => false,
        'url' => array(
            'hu' => 'felhasznalokezelo',
            'en' => 'usermanager',
        ),
        'controller' => 'BackendUsercontrolpanel',
        'action' => 'list',
        'childrens' => []
    ],
    'controllers' => [
        'BackendUsercontrolpanel' => 'Backend/UserManager/Controller/UsermanagerController',
    ]
];
