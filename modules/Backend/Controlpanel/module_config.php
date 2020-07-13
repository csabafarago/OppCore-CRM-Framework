<?php
use OppCoreClasses\Helper;

$route_childrens = [];
$load_backend_modules = include __DIR__ . '/../../../projects/' . Helper::$project_name. '/config/backend_modules.php';

foreach($load_backend_modules as $backend_module => $url_name){
    $module_data = include ROOT_DIR . '/modules//Backend/' .$backend_module .'/module_config.php';
    $route_childrens[$url_name] = $module_data['routes'];
}

return [
    'routes' => [
        [
            'admin_home' => [
                'name' => 'admin_home',
                'url' => [
                    'hu' => 'hu-admin',
                    'en' => 'en-admin',
                ],
                'module' => 'Controlpanel', 'controller' => 'Controlpanel', 'action' => 'index', 'view' => 'index',
                'childrens' => $route_childrens
            ]
        ]
    ],
];
