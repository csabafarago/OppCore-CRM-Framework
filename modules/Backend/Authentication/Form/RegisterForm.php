<?php

namespace modules\Frontend\Authentication\Form;

use OppCoreClasses\Form\FormRenderer;

class RegisterForm {

    public $form;

    function __construct($method) {
        $this->form = new FormRenderer($method);
    }

    public function createForm() {
        $this->form->addTextInput([
            'name' => 'username',
            'label_text' => 'Username',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Enter your username here',
            'required' => true,
            'pattern' => '[a-z]{3,5}',
            'validator' => [
                'regex' => '/[a-z]{3,5}/',
                'min_length' => 3,
                'max_length' => 5,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'first_name',
            'label_text' => 'First name',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Enter your first name here',
            'required' => true,
            'pattern' => '[a-z]',
            'validator' => [
                'regex' => '/[a-z]/',
                'min_length' => 1,
                'max_length' => 5,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'last_name',
            'label_text' => 'Last name',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Enter your last name here',
            'required' => true,
            'pattern' => '[a-z]',
            'validator' => [
                'regex' => '/[a-z]/',
                'min_length' => 1,
                'max_length' => 1,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);
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
                'min_length' => 2,
                'max_length' => 5,
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
            'class' => '',
            'placeholder' => 'Enter yuor password here',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 1,
                'max_length' => 5,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ]
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'repassword',
            'label_text' => 'Re-Password',
            'label_class' => '',
            'id' => '',
            'type' => 'password',
            'class' => '',
            'placeholder' => 'Re Enter yuor password here',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 1,
                'max_length' => 5,
                'less_than' => 1000,
                'more_than' => 900,
                'between' => [
                    'min' => 100,
                    'max' => 120,
                ],
                'same_as' => 'password'
            ]
        ]);

        $this->form->addCheckboxInput([
            'name' => 'agrrement',
            'id' => 'id',
            'class' => 'class',
            'label_class' => '',
            'label_text' => 'You have to access user agreement to register',
            'options' => [
                '1' => 'Agree',
            ],
            'multiselect' => false,
            'required' => true,
        ]);
        
        $this->form->addSubmit('save', 'Registration');
        return $this->form->render();
    }

}