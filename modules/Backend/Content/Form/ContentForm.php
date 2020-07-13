<?php

namespace modules\Backend\Content\Form;

use OppCoreClasses\Form\FormRenderer;

class ContentForm {

    public $form;
    public $languages;

    function __construct($method = 'POST', $languages, $action) {
        $this->form = new FormRenderer($method, '', $action);
        $this->languages = $languages;
    }

    public function createForm($selectListArray) {
        foreach ($this->languages as $languages) {
            $this->form->addTextInput([
                'name' => $languages->lang_code . '_title',
                'label_text' => 'Title',
                'label_class' => 'col-sm-3 control-label',
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
                'name' => $languages->lang_code . '_lead',
                'label_text' => 'Lead',
                'label_class' => 'col-sm-3 control-label',
                'id' => 'inputName',
                'type' => 'text',
                //'default_value' => [],
                'class' => 'form-control',
                'placeholder' => '',
                'validator' => [],
                'required' => false,
                'pattern' => false,
            ]);
            $this->form->addTextareaInput([
                'name' => $languages->lang_code . '_text',
                'label_text' => 'Content',
                'label_class' => 'col-sm-3 control-label',
                'id' => $languages->lang_code . '_text',
                'type' => 'textarea',
                'rows' => 12,
                //'default_value' => [],
                'class' => 'form-control',
                'placeholder' => '',
                'validator' => [],
                'required' => false,
                'pattern' => false,
            ]);
            $this->form->addTextInput([
                'name' => $languages->lang_code . '_keywords',
                'label_text' => 'Keywords',
                'label_class' => 'col-sm-3 control-label',
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
                'label_class' => 'col-sm-3 control-label',
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
                'label_text' => 'Lanugage (lang id)',
                'label_class' => 'col-sm-3 control-label',
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
            'label_class' => 'col-sm-3 control-label',
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
            'name' => 'lead_image',
            'label_text' => 'Cover image',
            'label_class' => 'col-sm-3 control-label',
            'id' => '',
            'type' => 'text',
            //'default_value' => [],
            'class' => 'form-control',
            'placeholder' => '',
            'validator' => [],
            'required' => false,
            'pattern' => false,
        ]);
        $this->form->addSelectListInput([
            'name' => 'categories',
            'label_text' => 'Categories',
            'label_class' => 'col-sm-3 form-horizontal control-label font-weight-700-fix',
            'id' => '',
            'type' => 'selectlist',
            //'default_value' => [],
            'options' => $selectListArray,
            'class' => 'form-control select2',
            'placeholder' => 'Válasszon kategóriát a listából',
            'validator' => [],
            'required' => false,
            'pattern' => false,
            'multiselect' => true,
        ]);
        $this->form->addRadioInput([
            'name' => 'active',
            'id' => '',
            'class' => '',
            'label_class' => 'col-sm-3 form-horizontal control-label font-weight-700-fix',
            'label_text' => 'Public',
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
