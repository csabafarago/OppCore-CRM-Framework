<?php
namespace modules\Backend\Content\Controller;

use OppCoreClasses\View\View;
use modules\Backend\Content\Form\ContentForm;
use modules\Backend\Content\Model\ContentModel;
use OppCoreClasses\Helper;
use OppCoreClasses\Session\SessionManager;
//SelectList
use OppCoreClasses\Model\SelectList;
use OppCoreClasses\SystemHelpers\Generators\SelectListGenerator;
use OppCoreClasses\MVC\Controller;

class ContentController extends Controller{
        
    public function listAction (){
        $categories = (new ContentModel)->getContents($this->session->get('lang_id'));
        $this->view = new View();
        $this->view->set('data', $categories['data']);
        $this->view->set('create_link',
            Helper::getURL(['admin_home','list_contents','create_content'])
        );
        $this->view->set('edit_link',
            Helper::getURL(['admin_home','list_contents','edit_content','content_id'])
        );
        $this->view->set('delete_link',
            Helper::getURL(['admin_home','list_contents','remove_content','content_id'])
        );
        return [
            'output' => $this->view->output(),
        ];
    }
    
    public function editAction (){
        Helper::$action = 'add';
        $response = [];
        $model = new ContentModel();
        $selectList = (new SelectList)->getSelectList($this->session->get('lang_id'),0);
        $selectListArray = (new SelectListGenerator)->buildCategoryTree($selectList['data']);
        $form = new ContentForm('post', $this->session->get('languages'), $this->getFullUrl());
        if ($this->isPost() && $form->createForm($selectListArray) && $form->form->isValid()) {
            $result = $model->updateContent(
                    $_POST,
                    $this->session->get('user')->id,
                    $this->session->get('languages'));
            if($result['result'] == true){
                $response['type'] = 'success';
                $response['message'] = $result['message'];
                $response['new_url'] = Helper::getURL(['admin_home','list_contents']);
            } else {
                $response['type'] = 'failed';
                $response['message'] = $result['message'];
            }
        } else {
            $data = $model->getContent(
                \OppCoreClasses\RouteHelper::$params['content_id'],
                $this->session->get('languages'));
            $formData = [
                'dataNames' => [
                    'id', 'active' 
                ], 
                'langDataNames' => [
                    'title',
                    'lead',
                    'text',
                    'keywords',
                    'sef',
                ]
            ];
            $form->form->setData($formData,$data['data']);
            $form->form->setData('categories',$data['categories']);
            $form->createForm($selectListArray);
        }
        $this->view = new View();
        $this->view->set('languages', $this->session->get('languages'));
        $this->view->set('form', $form->form->render());
        $response['output'] = $this->view->output();
        return $response;
    }
    
    public function addAction(){
        $response = [];
        $selectList = (new SelectList)->getSelectList($this->session->get('lang_id'), 0);
        $selectListArray = (new SelectListGenerator)->buildCategoryTree($selectList['data']);
        $form = new ContentForm('post', $this->session->get('languages'), $this->getFullUrl());
        $form->createForm($selectListArray);
        if ($this->isPost() && $form->form->isValid()) {
            $category = new ContentModel();
            $result = $category->insertContent(
                    $_POST, 
                    $this->session->get('user')->id,
                    $this->session->get('languages'));
            if($result['result'] == true){
                $response['type'] = 'success';
                $response['message'] = $result['message'];
                $response['new_url'] = Helper::getURL(['admin_home','list_contents']);           
            } else {
                $response['type'] = 'failed';
                $response['message'] = $result['message'];
            }
        }
        $this->view = new View();
        $this->view->set('languages', $this->session->get('languages'));
        $this->view->set('form', $form->form->render());
        $response['output'] = $this->view->output();
        return $response;
    }
    
    public function removeAction() {
        $response = [];
        $response['new_url'] = Helper::getURL(['admin_home','list_contents']);
        $result = (new ContentModel())->deleteContent((int) \OppCoreClasses\RouteHelper::$params['content_id']);
        $response['message'] = $result['message'];
        if($result['result'] == true){
            $response['type'] = 'success';
        } else {
            $response['type'] = 'failed';
        }
        $response['output'] = '';
        return $response;
    }
}
