<?php

namespace OppCoreClasses;

class Helper {

    //refactored
    static $modul;
    static $controller;
    static $action;
    static $view;
    static $is_admin_url = false;
    static $environment = '';
    
    static $loaded_module_controllers = []; 
    
    public static $debug_toolbar_view_errors = [];
    //refactored
    static $project_name;
    static $current_page;
    static $page_config;
    //Submodule view rendeleléshez cacheli be a view file pontos helyét
    static $submoduleView;
    private static $translatedUrl;
    public static $lang_code;
    private static $config = [];
    public static $debugGeneratedUrl = [];
    
    static function load($config_file, $options = []) {
        switch ($config_file) {
            case 'config';
            case 'ModuleConfig';
                if (isset(self::$config[$config_file])) {
                    return self::$config[$config_file];
                }
                self::$config[$config_file] = include (ROOT_DIR . 'projects/' . self::$project_name . '/config/' . $config_file . '.php');
                return self::$config[$config_file];
                break;
            case 'get_module_path';
                $Path = 'modules/' . (self::$is_admin_url ? 'Backend' : 'Frontend') . '/' . self::$modul . '/View/'. self::$controller . '/' . self::$action . '/' . self::$view . '.phtml';
                self::$loaded_module_controllers[] = $Path;
                return $Path;
                break;
            case 'positions';
            case 'mobile_positions';
            case 'backend_positions';
                $loaded_positions = null;
                $positions_array = include_once (ROOT_DIR . 'projects/' . self::$project_name . '/config/' . $config_file . '.php');
                foreach ($positions_array as $position) {
                    if ($position['params']['lang'] == $options['lang'] && (strpos($options['url'], $position['params']['url'])) !== false) {
                        $loaded_positions = $position['positions'];
                        //Ha a beérkező url megeggyezik a configban levővel akkor nem keresünk tovább
                        if ($position['params']['url'] == $options['url']) {
                            break;
                        }
                    }
                }
                return $loaded_positions;
                break;
            case 'layout';
            case 'admin_layout';
            case 'mobile_layout';
                return ROOT_DIR . 'projects/' . self::$project_name . '/template/' . (empty($options) ? $config_file : $options) . '.phtml';
                break;
            case 'load_view';
                $view_path = 'modules/'. (self::$is_admin_url ? 'Backend':'Frontend') .'/'.self::$modul.'/View/'.self::$controller.'/'.self::$action.'/'.self::$view . '.phtml';
                echo $view_path;
                if(is_file(ROOT_DIR . $view_path)){
                    return ROOT_DIR . $view_path;
                } else {
                    if(DEVELOPER_MODE){
                        self::$debug_toolbar_view_errors[] = [
                            'module_data' => self::$modul . ' ' . self::$controller.'Controller',
                            'view_location' => self::$controller.'/'.self::$action.'/'.self::$view . '.phtml'
                        ];
                    }
                }
                break;
            case 'load_controller';
                return str_replace('/', '\\', 'modules/' .(self::$is_admin_url ? 'Backend' : 'Frontend').'/'.self::$modul.'/Controller/'.self::$controller.'Controller');
                break;
            default:
                break;
        }
    }

    /**
     * 
     * @param type $urlAliasArray URL names in array exp: ['admin_home', 'admin_login_page']
     * @param type $lang Contains the language coda exp: "hu | en | de ...etc"
     * @param type $params Contains $GET params which will add end of the url after url translated
     * @return type string Contains the translated url for example: /admin/login
     */
    static function getURL($urlAliasArray, $currentURL = false) {
        $url_array_count = count($urlAliasArray) - 1;
        $urlAliasArrayCounter = 0;
        self::$translatedUrl = '';
        foreach (ModuleHelper::$loaded_module_routes as $key => $route) {
            if (isset($route[$urlAliasArray[$urlAliasArrayCounter]])) {
                self::$translatedUrl .= '/' . $route[$urlAliasArray[$urlAliasArrayCounter]]['url'][self::$lang_code];
                if ($url_array_count == 0) {
                    if (DEVELOPER_MODE) {
                        self::$debugGeneratedUrl[] = [
                            'raw_url' => implode(',', $urlAliasArray),
                            'translated_url' => self::$translatedUrl
                        ];
                    }
                    return self::$translatedUrl . ($currentURL ? '?url=' . $_SERVER['SERVER_NAME'] . RouteHelper::$REGUESTED_URL : '');
                } else {
                    self::getURLHelper(
                            $route[$urlAliasArray[$urlAliasArrayCounter]]['childrens'], self::$translatedUrl, $urlAliasArray, ++$urlAliasArrayCounter, $url_array_count
                    );
                    if (DEVELOPER_MODE) {
                        self::$debugGeneratedUrl[] = [
                            'raw_url' => implode(',', $urlAliasArray),
                            'translated_url' => self::$translatedUrl
                        ];
                    }
                    return self::$translatedUrl . ($currentURL ? '?url=' . $_SERVER['SERVER_NAME'] . RouteHelper::$REGUESTED_URL : '');
                }
            }
        }
    }

    static function getURLHelper($routes, $translatedUrl, $urlAliasArray, $urlAliasArrayCounter, $urlArrayCount) {
        foreach ($routes as $route_name => $route) {
            if ($route_name == $urlAliasArray[$urlAliasArrayCounter]) {
                if (isset($route['url'][self::$lang_code])) {
                    self::$translatedUrl .= '/' . $route['url'][self::$lang_code];
                } else {
                    self::$translatedUrl .= '/[' . $route['name'] . ']';
                }
                if ($urlArrayCount == $urlAliasArrayCounter) {
                    return self::$translatedUrl;
                    break;
                } else {
                    $urlAliasArrayCounter++;
                    self::getURLHelper($route['childrens'], $translatedUrl, $urlAliasArray, $urlAliasArrayCounter, $urlArrayCount);
                }
            }
        }
    }

    static function redirectToUrl($url, $statusCode = 303, $permanent = false) {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    }

}
