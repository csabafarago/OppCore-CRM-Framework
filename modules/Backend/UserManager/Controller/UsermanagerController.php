<?php
namespace modules\Backend\UserManager\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\MVC\Controller;

class UsermanagerController extends Controller{
    
    public function listAction (){
        $this->view = new View();
        $this->view->set('username', 'Csaba');
        return [
            'output' => $this->view->output(),
            //'set_layout' => 'custom_login'
        ];
    }
}
