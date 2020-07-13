<?php
namespace modules\Backend\Widget\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\Helper;
use OppCoreClasses\Session\SessionManager;

class UserProfileWidgetController{
    
    private $session;
    
    public function indexAction (){
        
        $this->session = new SessionManager();
        $this->view = new View();
        $this->view->set('logout_url',Helper::getURL(['logout_page']));
        $this->view->set('username',$this->session->get('user')->username);
        return $this->view->output();
        
    }
}