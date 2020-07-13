<?php
namespace modules\Backend\System\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\MVC\Controller;

class UploadController extends Controller{
        
    public function tinymcefileuploadAction (){
        $this->view = new View();
        return [
            'json' => true,
            'url' => 'https://wallpapers.wallhaven.cc/wallpapers/full/wallhaven-504300.jpg',
            'output' => $this->view->output(),
        ];
    }
}
