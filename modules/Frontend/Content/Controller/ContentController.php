<?php
namespace modules\Frontend\Content\Controller;

use OppCoreClasses\View\View;
use modules\Frontend\Content\Model\ContentModel;
use OppCoreClasses\MVC\Controller;

class ContentController extends Controller{

    public function indexAction (){
        $this->view = new View();
        $this->view->set('content', 'Content details from content submodule');
        return $this->view->output();
    }

    public function contentsAction (){
        $contents = new ContentModel();
        $this->view = new View();
        $this->view->set('contents', $contents->getContents());
        return ['output' => $this->view->output()];
    }
    
    public function showcontentAction (){
        $contents = new ContentModel();
        $this->view = new View();
        $contentData = $contents->getContentBySef(
                \OppCoreClasses\RouteHelper::$params['content_sef'],
                $this->session->get('lang_id')
                );
        if($contentData['result']){
            $this->view->set('content', $contentData['contentData']);
            $this->view->set('categories', $contentData['categories']);
        } else {
            $this->set404Page();
        }
        return ['output' => $this->view->output()];
    }
}
