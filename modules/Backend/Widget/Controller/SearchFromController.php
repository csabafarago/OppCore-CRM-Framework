<?php
namespace modules\BackendSubmodules\SearchFrom\Controller;

use OppCoreClasses\View\View;

class SearchFromController{
    public function indexAction (){
        
        $this->view = new View('submodule');
        $this->view->set('menuitem', 'Admin');
        return $this->view->output();
        
    }
}