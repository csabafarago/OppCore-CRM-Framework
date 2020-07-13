<?php
namespace modules\Frontend\Authentication\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\Helper;
use modules\Frontend\Authentication\Form\RegisterForm;
use modules\Frontend\Authentication\Model\UserModel;
use modules\Frontend\Authentication\Form\LoginForm;
use OppCoreClasses\MVC\Controller;

class AuthenticationController extends Controller{
        
    public function registrationAction (){
        $form = new RegisterForm();
        $form->createForm();
        $this->view = new View();
        if ($this->isPost() && $form->form->isValid()) {
            $user = new UserModel();
            $registrationResult = $user->registerUser($_POST);
            if($registrationResult['result'] == true){
                //TODO success message
                Helper::redirectToUrl('/');
            } else {
                $this->view->set('error_message', $registrationResult['message']);
            }
        }
        $this->view->set('form', $form->form->output);
        return [
            'output' => $this->view->output(),
        ];
    }

    public function loginAction (){
        $form = new LoginForm('post');
        $form->createForm();
        if ($this->isPost() && $form->form->isValid()) {
            $user = new UserModel();
            $user->authenticationUser($_POST);
        }
        $this->view = new View();
        $this->view->set('form', $form->form->output);
        return [
            'output' => $this->view->output(),
        ];
    }
    
    public function logoutAction (){
        $this->session->removeSession('user');
        Helper::redirectToUrl('/');
    }
}
