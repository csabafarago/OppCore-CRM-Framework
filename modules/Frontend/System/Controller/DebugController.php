<?php
namespace modules\Frontend\System\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\MVC\Controller;
use OppCoreClasses\ModuleHelper;
use OppCoreClasses\Helper;

class DebugController extends Controller{
    
    private $_route_temp =[];
    private $_routeList = '';
    
    public function routesAction (){
        $this->view = new View();
        foreach (ModuleHelper::$loaded_module_routes as $routes){
            $this->drawRouteLinks($routes);
        }
        $this->view->set('route_list', $this->_routeList);
        return [
            'output' => $this->view->output(),
        ];
    }
    
    public function debuglistAction (){
        $this->view = new View();
        $this->view->set('langCode', $this->session->get('lang'));
        return [
            'output' => $this->view->output(),
        ];
        
    }
    
    private function drawRouteLinks($routes){
        foreach ($routes as $route){
            $this->_route_temp[] = $route['name'];
//            $this->_routeList .= '-';
//            $this->_routeList .= '<div>Execute: '.$route['controller']. '=>'.$route['action'].'</div>';
            $this->_routeList .= 'Raw url: \''. implode('\', \'', $this->_route_temp). '\'</br>';
            $url = '';
            if(is_array($route['url'])){
                $url = Helper::getURL($this->_route_temp);;
            } else {
                $x_cache = $this->_route_temp;
                array_pop($x_cache);
                $url = Helper::getURL($x_cache);;
                $url .= '/['.$route['name'].']';
            }
            $this->_routeList .= '<a href="'. $url .'">'.$url.'</a></br>';
            if(!empty($route['childrens'])){
                $this->drawRouteLinks($route['childrens']);
            }
            array_pop($this->_route_temp);
        }
    }
}