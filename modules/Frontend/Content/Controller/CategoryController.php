<?php
namespace modules\Frontend\Content\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\Session\SessionManager;
use OppCoreClasses\Helper;
use OppCoreClasses\SystemHelpers\Generators\CategoryTreeBuilder;
use modules\Frontend\Content\Model\CategoryModel;

class CategoryController{
    public function indexAction (){
        $session = new SessionManager();
        $category = new CategoryModel();
        $categoryList = $category->getCategoriesList($session->get('lang_id'));
        $navigation = new CategoryTreeBuilder();
        $this->view = new View();
        if($categoryList['result'] == true){
            $this->view->set('categoryTree', $navigation->buildCategoryTree($categoryList['data']));
        } else {
            $this->view->set('categoryTree', 'Category tree');
        }
        return $this->view->output();
   }
}