<?php
namespace modules\Frontend\System\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\SystemHelpers\Generators\SefNameGenerator;
use OppCoreClasses\MVC\Controller;

class ErrorController extends Controller{
    public function error404Action (){
        $this->view = new View();
        $this->view->set('error', '404-es hiba történt');
        iF(isset($_GET['url'])){
            $this->view->set('original_url', $_GET['url']);
        }
        return [
            'output' => $this->view->output(),
        ];
        
    }
}