<?php
namespace modules\BackendSubmodules\UserNotificationsMenu\Controller;

use OppCoreClasses\View\View;

class UserNotificationsMenuController{
    public function indexAction (){
        
        $this->view = new View('submodule');
        $this->view->set('menuitem', 'Admin');
        return $this->view->output();
        
    }
}