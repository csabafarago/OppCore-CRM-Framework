<?php

namespace modules\Frontend\Authentication\Form;

use OppCoreClasses\Form\FormRenderer;
use OppCoreClasses\Helper;

class LoginForm {

    public $form;
    private $login_field_type;

    function __construct($method) {
        $this->form = new FormRenderer($method);
        $this->login_field_type = Helper::load('config')
            ['authentication_settings']
            ['login_field_type'];
    }

    public function createForm() {
        if ($this->login_field_type == 'username') {
            $this->form->addTextInput([
                'name' => 'username',
                'label_text' => 'Username',
                'label_class' => '',
                'id' => '',
                'type' => 'text',
                'class' => '',
                'placeholder' => 'Enter your username here',
                'required' => true,
                'pattern' => '[a-z]{5,30}',
                'validator' => [
                    'regex' => '/[a-z]{5,30}/',
                    'min_length' => 5,
                    'max_length' => 30,
                ]
            ]);
        } else if ($this->login_field_type == 'email') {
            $this->form->addTextInput([
                'name' => 'email',
                'label_text' => 'E-mail',
                'label_class' => '',
                'id' => '',
                'type' => 'email',
                'class' => '',
                'placeholder' => 'Enter your email here',
                'required' => true,
                'pattern' => '',
                'validator' => [
                    'regex' => '/[a-z]/',
                    'min_length' => 5,
                    'max_length' => 100,
                ]
            ]);
        }

        $this->form->addTextInput([
            'name' => 'password',
            'label_text' => 'Password',
            'label_class' => '',
            'id' => '',
            'type' => 'password',
            //'default_value' => array(),
            'class' => '',
            'placeholder' => 'Enter yuor password here',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 5,
                'max_length' => 40,
            ]
        ]);

        $this->form->addSubmit('login', 'Login');
        return $this->form->render();
    }

}
