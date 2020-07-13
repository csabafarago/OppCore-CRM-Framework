<?php
namespace modules\BackendSubmodules\UserTasksMenu\Controller;

use OppCoreClasses\View\View;

class UserTasksMenuController{
    public function indexAction (){
        
        $this->view = new View('submodule');
        $this->view->set('menuitem', 'Admin');
        return $this->view->output();
        
    }
}