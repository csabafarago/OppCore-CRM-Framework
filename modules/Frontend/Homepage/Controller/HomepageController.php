<?php
namespace modules\Frontend\Homepage\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\MVC\Controller;

class HomepageController extends Controller{
    public function indexAction (){
        $this->view = new View();
        return [
            'output' => $this->view->output(),
        ];
    }
}