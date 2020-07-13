<?php

namespace modules\Backend\Content\Form;

use OppCoreClasses\Form\FormRenderer;

class ContentForm {

    public $form;

    function __construct($method) {
        $this->form = new FormRenderer($method);
    }

    public function createForm() {
        //$form->add('text','name_field','input_class', 'User name','username-class','Enter your username','[d]', true);
        $this->form->addTextInput(array(
            'name' => 'full_name',
            'label_text' => 'Full name',
            'label_class' => 'full_name_label_class',
            'id' => 'identifier',
            'type' => 'text',
            'class' => 'input class',
            'placeholder' => 'Enter your username here',
            'required' => true,
            'pattern' => '[a-z]{1}',
            'validator' => [],
        ));
        $this->form->addRadioInput([
            'name' => 'gender',
            'id' => 'id',
            'class' => 'class',
            'label_class' => 'gender_class',
            'label_text' => 'Chose your gender',
            'options' => [
                'male' => 'Male',
                'female' => 'Female'
            ],
        ]);
        $this->form->addRadioInput([
            'name' => 'gender_second',
            'id' => 'id',
            'class' => 'class',
            'label_class' => 'gender_class',
            'label_text' => 'Chose your gender',
            'options' => [
                'male' => 'Male',
                'female' => 'Female'
            ],
        ]);
        $this->form->addCheckboxInput([
            'name' => 'favorite_meal',
            'id' => 'id',
            'class' => 'class',
            'label_class' => 'gender_class',
            'label_text' => 'Chose your gender',
            'options' => [
                'meal' => 'Meal',
                'cheese' => 'Cheese'
            ],
            'required' => false,
            'multiselect' => true
        ]);
        $this->form->addTextInput(array(
            'name' => 'favorite_sport',
            'label_text' => 'Favorite sport',
            'label_class' => 'full_name_label_class',
            'id' => 'favorite_sport',
            'type' => 'text',
            //'default_value' => array(),
            'class' => 'input class',
            'placeholder' => 'Examples:Gold, Run downside on the hill',
            'required' => false,
            'pattern' => false,
            'validator' => [],
        ));
        $this->form->addSubmit('save', 'Save record');
        return $this->form->render();
    }

}
