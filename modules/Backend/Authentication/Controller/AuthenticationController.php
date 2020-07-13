<?php

namespace modules\Backend\Authentication\Controller;

use OppCoreClasses\View\View;
use OppCoreClasses\Helper;
use modules\Backend\Authentication\Model\UserModel;
use modules\Backend\Authentication\Form\LoginForm;
use OppCoreClasses\MVC\Controller;

class AuthenticationController extends Controller {

    public function loginAction() {
        $form = new LoginForm('post');
        $form->createForm();
        $this->view = new View();
        if ($this->isPost() && $form->form->isValid()) {
            $user = new UserModel();
            $login_result = $user->authenticationUser($_POST);
            if ($login_result['result'] == true) {
                $this->session->set('user', $login_result['user_data']);
                Helper::redirectToUrl(Helper::getURL(['admin_home']));
            } else {
                $this->view->set('error_message', 'Helytelen e-mail cím vagy jelszó.');
            }
        }
        $project_title = Helper::load('config')['page_data']['page_title'][$this->session->get('lang')];
        $this->setTerminate(true);
        $this->view->set('title', $project_title);
        $this->view->set('form', $form->form->output);
        return [
            'output' => $this->view->output(),
        ];
    }

}
