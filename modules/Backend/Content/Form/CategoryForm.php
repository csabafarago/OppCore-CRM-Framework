<?php

namespace modules\Backend\Content\Form;

use OppCoreClasses\Form\FormRenderer;

class CategoryForm {

    public $form;
    public $languages;

    function __construct($method = 'POST', $languages, $action) {
        $this->form = new FormRenderer($method, '', $action);
        $this->languages = $languages;
    }

    public function createForm() {
        foreach ($this->languages as $languages) {
            $this->form->addTextInput([
                'name' => $languages->lang_code . '_category_name',
                'label_text' => 'Name',
                'label_class' => 'col-sm-2 control-label',
                'id' => 'inputName',
                'type' => 'text',
                //'default_value' => [],
                'class' => 'form-control',
                'placeholder' => '',
                'validator' => [],
                'required' => false,
                'pattern' => false,
            ]);
            $this->form->addTextInput([
                'name' => $languages->lang_code . '_sef',
                'label_text' => 'SEF',
                'label_class' => 'col-sm-2 control-label',
                'id' => 'inputName',
                'type' => 'text',
                //'default_value' => [],
                'class' => 'form-control',
                'placeholder' => '',
                'validator' => [],
                'required' => false,
                'pattern' => false,
            ]);

            $this->form->addTextInput([
                'name' => $languages->lang_code . '_lang_id',
                'label_text' => 'Language(lang id)',
                'label_class' => 'col-sm-2 control-label',
                'id' => '',
                'type' => 'text',
                'default_value' => [$languages->lang_id],
                'class' => 'form-control',
                'placeholder' => '',
                'validator' => [],
                'required' => false,
                'pattern' => false,
            ]);
        }
        $this->form->addTextInput([
            'name' => 'id',
            'label_text' => '',
            'label_class' => 'col-sm-2 control-label',
            'id' => '',
            'type' => 'hidden',
            //'default_value' => [],
            'class' => 'form-control',
            'placeholder' => '',
            'validator' => [],
            'required' => false,
            'pattern' => false,
        ]);
        $this->form->addTextInput([
            'name' => 'parent_id',
            'label_text' => 'Parent',
            'label_class' => 'col-sm-2 control-label',
            'id' => '',
            'type' => 'text',
            //'default_value' => [],
            'class' => 'form-control',
            'placeholder' => '',
            'validator' => [],
            'required' => false,
            'pattern' => false,
        ]);
        $this->form->addRadioInput([
            'name' => 'active',
            'id' => '',
            'class' => '',
            'label_class' => 'col-sm-2 form-horizontal control-label font-weight-700-fix',
            'label_text' => 'Status',
            'options' => [
                '0' => 'Hide',
                '1' => 'Visible'
            ],
            'required' => false,
        ]);
        $this->form->addSubmit('save', 'Save record', 'btn btn-danger');
        return $this->form->render();
    }

}
