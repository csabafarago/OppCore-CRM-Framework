<?php
namespace OppCoreClasses;

class ModuleHelper{

    static $loaded_module_routes = [];
    static $current_page_loaded_modules = [];

    static function LoadModuleConfigs($page_config = []){
        Helper::$environment = $page_config[$_SERVER['SERVER_NAME']]['environment'];
        $current_page = $page_config [$_SERVER['SERVER_NAME']]['project'];
        Helper::$project_name = $current_page;
        $domain_config = include_once (__DIR__ . '/../projects/' .$current_page.'/config/active_modules.php');
        self::$current_page_loaded_modules = $domain_config;
        foreach (self::$current_page_loaded_modules as $package_container => $module) {
            $package_dir =  __DIR__ . '/../modules/' . $package_container;
            foreach ($module as $module_folder) {
                $module_route_config = include_once ($package_dir . '/' . $module_folder . '/module_config.php');
                self::$loaded_module_routes = array_merge_recursive(self::$loaded_module_routes, $module_route_config['routes']);
            }
        }
        return self::$loaded_module_routes;
    }

}
