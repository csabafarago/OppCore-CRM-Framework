<?php
namespace modules\Backend\Controlpanel\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\MVC\Controller;

class ControlpanelController extends Controller{ 
        
    public function indexAction (){
        $this->view = new View();
        return [
            'output' => $this->view->output(),
        ];
    }
}