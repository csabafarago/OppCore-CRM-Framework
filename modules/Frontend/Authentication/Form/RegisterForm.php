<?php

namespace modules\Frontend\Authentication\Form;

use OppCoreClasses\Form\FormRenderer;

class RegisterForm {

    public $form;

    function __construct($method = 'post') {
        $this->form = new FormRenderer($method);
    }

    public function createForm() {
        $this->form->addTextInput([
            'name' => 'username',
            'label_text' => 'Bejelentkezési név',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Írd be a felhasználóneved ...',
            'required' => true,
            'pattern' => '[a-zA-Z]{5,30}',
            'validator' => [
                'regex' => '/[a-z]{5,30}/',
                'min_length' => 5,
                'max_length' => 30,
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'first_name',
            'label_text' => 'Keresztneved',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Írd be a keresztneved ...',
            'required' => true,
            'pattern' => '[a-zA-Z éáűúőpóüö1-9]{4,30}',
            'validator' => [
                'regex' => '/[a-zA-Z éáűúőpóüö1-9]{4,30}/',
                'min_length' => 4,
                'max_length' => 30,
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'last_name',
            'label_text' => 'Vezetékneved',
            'label_class' => '',
            'id' => '',
            'type' => 'text',
            'class' => '',
            'placeholder' => 'Írd be a vezetékneved ...',
            'required' => true,
            'pattern' => '[a-zA-Z éáűúőpóüö1-9]{4,30}',
            'validator' => [
                'regex' => '/[a-zA-Z éáűúőpóüö1-9]{4,30}/',
                'min_length' => 4,
                'max_length' => 30,
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'email',
            'label_text' => 'E-mail',
            'label_class' => '',
            'id' => '',
            'type' => 'email',
            'class' => '',
            'placeholder' => 'email@példa.hu',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 6,
                'max_length' => 80,
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'password',
            'label_text' => 'Jelszó',
            'label_class' => '',
            'id' => '',
            'type' => 'password',
            'class' => '',
            'placeholder' => '***********',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 5,
                'max_length' => 40,
            ]
        ]);
        $this->form->addTextInput([
            'name' => 'repassword',
            'label_text' => 'Jelszó megismétlése',
            'label_class' => '',
            'id' => '',
            'type' => 'password',
            'class' => '',
            'placeholder' => '***********',
            'required' => true,
            'pattern' => '',
            'validator' => [
                'regex' => '',
                'min_length' => 5,
                'max_length' => 40,
                'same_as' => 'password'
            ]
        ]);

        $this->form->addCheckboxInput([
            'name' => 'agrrement',
            'id' => 'id',
            'class' => 'class',
            'label_class' => '',
            'label_text' => 'A felhasználási feltételek elfogása szükséges regisztrációhoz.',
            'options' => [
                '1' => 'Eggyetértek',
            ],
            'multiselect' => false,
            'required' => true,
        ]);
        
        $this->form->addSubmit('save', 'Regsiztrálok');
        return $this->form->render();
    }

}