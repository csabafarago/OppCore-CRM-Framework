<?php
namespace modules\Backend\Content\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\Helper;
use OppCoreClasses\MVC\Controller;
use modules\Backend\Content\Form\CategoryForm;
use modules\Backend\Content\Model\CategoryModel;
use OppCoreClasses\RouteHelper;

class CategoryController extends Controller{
        
    public function listAction (){
        $categories = (new CategoryModel)->listCategories($this->session->get('lang_id'));
        $this->view = new View();
        if($categories['result'] == true){
            $this->view->set('categories', $categories['data']);
        } else {
            $this->view->set('message', 'Something went wrong.');
        }
        $this->view->set('create_category',
            Helper::getURL(['admin_home','list_contents','categories','create_category'])
        );
        $this->view->set('category_edit_link',
            Helper::getURL(['admin_home','list_contents','categories','edit_category'])
        );
        $this->view->set('category_delete_link',
            Helper::getURL(['admin_home','list_contents','categories','remove_category'])
        );
        return [
            'output' => $this->view->output(),
        ];
    }
    
    public function addAction (){
        $response = [];
        $form = new CategoryForm('post', $this->session->get('languages'), $this->getFullUrl());
        $form->createForm();
        if ($this->isPost() && $form->form->isValid()) {
            $result = (new CategoryModel)->insertCategory($_POST);
            if($result['result'] == true){
                $response['type'] = 'success';
                $response['message'] = $result['message'];
                $response['new_url'] = Helper::getURL(['admin_home','list_contents','categories']);     
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
    
    public function deleteAction(){
        $result = (new CategoryModel())->deleteCategory(RouteHelper::$params['remove_category_id']);
        if($result['result'] == true){
            Helper::redirectToUrl(Helper::getURL(['admin_home','list_contents','categories']));
        }
    }
    
    public function editAction(){
        Helper::$action = 'add';
        $response = [];
        $category = new CategoryModel();
        $form = new CategoryForm('post', $this->session->get('languages'), $this->getFullUrl());
        if ($this->isPost() && $form->createForm() && $form->form->isValid()) {
            $result = $category->updateCategory($_POST);
            if($result['result'] == true){
                $response['type'] = 'success';
                $response['message'] = $result['message'];
                $response['new_url'] = Helper::getURL(['admin_home','list_contents','categories']);    
            }
        } else {
            $categoryData = $category->getCategory(
                RouteHelper::$params['edit_category_id'],
                $this->session->get('languages'));
            $formData = [
                'dataNames' => [
                    'id', 'parent_id', 'active' 
                ], 
                'langDataNames' => [
                    'category_name',
                    'sef'
                ]
            ];
            $form->form->setData($formData,$categoryData['data']);
            $form->createForm();
        }
        $this->view = new View();
        $this->view->set('languages', $this->session->get('languages'));
        $this->view->set('form', $form->form->render());
        $response['output'] = $this->view->output();
        return $response;
    }
}
