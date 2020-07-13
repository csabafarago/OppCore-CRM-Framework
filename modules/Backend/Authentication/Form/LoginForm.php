<?php

namespace modules\Backend\Authentication\Form;

use OppCoreClasses\Form\FormRenderer;

class LoginForm {

    public $form;

    function __construct($method) {
        $this->form = new FormRenderer($method);
    }

    public function createForm() {
        $this->form->addTextInput([
            'name' => 'email',
            'label_text' => 'E-mail',
            'label_class' => '',
            'id' => '',
            'type' => 'email',
            'class' => 'form-control',
            'placeholder' => 'e-mail',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '/[a-z]/',
                'min_length' => 2,
                'max_length' => 50,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);

        $this->form->addTextInput([
            'name' => 'password',
            'label_text' => 'Password',
            'label_class' => '',
            'id' => '',
            'type' => 'password',
            //'default_value' => array(),
            'class' => 'form-control',
            'placeholder' => '***************',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 1,
                'max_length' => 50,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);

        $this->form->addSubmit('login', 'Login');
        return $this->form->render();
    }

}
