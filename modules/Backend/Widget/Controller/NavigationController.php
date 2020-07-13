<?php
namespace modules\Backend\Widget\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\SystemHelpers\Generators\NavigationBuilder;

class NavigationController{
    public function indexAction (){
        $this->view = new View();
        $this->view->set('menuitem', 'Admin');
        $navigation = new NavigationBuilder();
        $this->view->set('navigation', $navigation->drawSidebarMenu());
        return $this->view->output();
        
    }
}