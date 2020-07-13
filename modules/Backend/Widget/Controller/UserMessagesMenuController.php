<?php
namespace modules\BackendSubmodules\UserMessagesMenu\Controller;

use OppCoreClasses\View\View;

class UserMessagesMenuController{
    public function indexAction (){
        $this->view = new View('submodule');
        $this->view->set('menuitem', 'Admin');
        return $this->view->output();
        
    }
}