<?php
namespace OppCoreClasses;

use OppCoreClasses\Session\SessionManager;
use OppCoreClasses\SystemHelpers\LangTable;

class RouteHelper{
    
    private $site_languages = [];
    private $router_result = false;
    static public $params = [];
    static public $REGUESTED_URL = '';
    private $session = null;
    
    public function explodeRequestUrl(){
        $URLpath = self::$REGUESTED_URL = rawurldecode($_SERVER["REQUEST_URI"]);
        if (strpos($URLpath, '?') !== false) {
            $URLpath = strstr($URLpath, '?', true);
        } else if(substr($URLpath, -1) == '/'){
            //If the URL ends with / symbol we delete it end of string 
            $URLpath = substr($URLpath, 0, -1);
        }
        return explode('/', substr($URLpath, 1));
    }

    public function ValidateURL($loaded_routes, $URLpath){
        $this->session = new SessionManager();
        if(!$this->session->get('languages')){
            $this->session->set('languages', (new LangTable)->getLanguages());
        }
        $this->session->set('prev_lang', $this->session->get('lang'));
        $this->session->set('lang', null);
        $this->site_languages = Helper::load('config')['site_config']['languages'];
        foreach ($loaded_routes as $routes) {
            $route_deep_counter = 0;
            $this->checkNextRouteLevel($routes, $URLpath, $route_deep_counter);
            if(!empty($this->router_result)){
                break;
            } else {
                self::$params = [];
            }
        }
        return $this->router_result;
    }
    
    private function checkNextRouteLevel($routes, $URLpath, $route_deep_counter){
        //var_dump($routes);
        foreach ($routes as $route){
            if($this->session->get('lang') == null){
                foreach ($this->site_languages as $lang_key){
                    if (is_array($route['url']) 
                        && $route['url'][$lang_key] == $URLpath[$route_deep_counter]){
                        $this->session->set('lang', $lang_key);
                        $this->session->set('lang_id', (new LangTable)->getLangId());
                    }
                }
            }
            if($this->session->get('lang') != null && !empty($route)){
                if (is_array($route['url'])
                && $route['url'][$this->session->get('lang')] == $URLpath[$route_deep_counter]
                ||!is_array($route['url'])
                && preg_match($route['url'], $URLpath[$route_deep_counter])){
                    if(!isset($URLpath[$route_deep_counter+1])){
                        self::$params[$route['name']] = $URLpath[$route_deep_counter];
                        $this->router_result = [
                            'module' => $route['module'],
                            'controller' => $route['controller'],
                            'action' => $route['action'],
                            'view' => $route['view'],
                        ];
                        break;
                    } else if (!empty($route['childrens'])){
                        self::$params[$route['name']] = $URLpath[$route_deep_counter];
                        $this->checkNextRouteLevel($route['childrens'], $URLpath, $route_deep_counter+1);
                    }
                }
            }
        }
        return $this->router_result;
    }
}