<?php
namespace modules\BackendSubmodules\UserPanel\Controller;

use OppCoreClasses\View\View;

class UserPanelController{
    public function indexAction (){
        
        $this->view = new View('submodule');
        $this->view->set('menuitem', 'Admin');
        return $this->view->output();
        
    }
}