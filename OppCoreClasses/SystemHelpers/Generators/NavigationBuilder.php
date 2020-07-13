<?php

namespace OppCoreClasses\SystemHelpers\Generators;

use OppCoreClasses\RouteHelper;
use OppCoreClasses\Session\SessionManager;
use OppCoreClasses\Helper;

class NavigationBuilder {
    
    private $output;
    private $current_language;

    public function drawSidebarMenu() {
        $sidebarNavigation = [];
        $link = false;
    
        $enabledBackendModules = include ROOT_DIR . '/projects/'.Helper::$project_name.'/config/backend_modules.php';
        $enabledBackendModules['Controlpanel'] = 'admin_home';
        foreach ($enabledBackendModules as $key => $route_lang){
            $sidebarNavigation = array_merge(include ROOT_DIR . '/modules/Backend/'.$key.'/menu_config.php',$sidebarNavigation);
        }
        $this->current_language = (new SessionManager())->get('lang');
        $routeArrayLength = count(RouteHelper::$params) - 1;
        $this->output .= '<ul class="sidebar-menu">';

        foreach ($sidebarNavigation as $navigation) {
            $link = $this->generateLinkUrl($navigation['link']);
            $this->output .= 
                    '<li class="'. ($navigation['i'] ? '' : 'header ') 
                    . (!empty($navigation['childrens']) ? ' treeview ': '').'">'
                    . ($navigation['type'] != 'header' ? '<a href="'. ($link ? $link : '#') . '">' : '')
                    . ($navigation['i'] ? '<i class="'.$navigation['i'].'"></i>' : '')
                    . (!empty($navigation['childrens'])? ' <i class="fa fa-angle-left pull-right"></i> ': '')
                    . '<span>'.$navigation['name'][$this->current_language] .'</span>'
                    . ($navigation['type'] != 'header' ? '</a>': '');
            if(!empty($navigation['childrens'])) {
                $this->output .= '<ul class="treeview-menu">';
                foreach($navigation['childrens'] as $navigationChild){
                    $link = $this->generateLinkUrl($navigationChild['link']);
                    $this->output .= '<li><a href="'.$link .'">'
                            . ($navigation['i'] ? '<i class="'.$navigation['i'].'"></i> ' : '')
                            . $navigationChild['name'][$this->current_language].'</a></li>';
                }
                $this->output .= '</ul>';
            }
            $this->output .= '</li>';
        }
        $this->output .= '</ul>';
        return $this->output;
    }
    
    private function generateLinkUrl($navigationLink){
        if($navigationLink != false && is_array($navigationLink)){
            return Helper::getURL($navigationLink);
        } else {
            return false;
        }
    }
}