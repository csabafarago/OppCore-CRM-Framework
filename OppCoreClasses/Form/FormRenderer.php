<?php

namespace OppCoreClasses\Form;

use OppCoreClasses\Session\SessionManager;

class FormRenderer {

    public $output = [];
    private $validator;
    private $radio_counter = 0;
    private $checkbox_counter = 0;
    private $data = [];

    function __construct($method = 'POST', $class = '', $action = '', $file_upload = false) {
        $this->output['open'] = '<form method="' . $method . '" action="' . $action . '" class="admin-form ' . $class . '" '.($file_upload ?' enctype="multipart/form-data" ' : '').'>';
    }

    public function addRadioInput($attributes) {
        $this->output[$attributes['name'] . '_error'] = null;
        if ($attributes['label_text']) {
            $this->output[$attributes['name'] . '_label'] = '<label class="' . $attributes['label_class'] . '">'
                    . '' . $attributes['label_text'] . '</label>';
        }
        $this->output[$attributes['name'] . '_radio'] = '';
        foreach ($attributes['options'] as $option_value => $option) {
            $this->output[$attributes['name'] . '_radio'] .=
                    '<input type="radio"'
                    . ' name="' . $attributes['name'] . '"'
                    . ' required id="' . $this->radio_counter . '_' . $option_value . '"'
                    . (isset($this->data[$attributes['name']]) && $option_value == $this->data[$attributes['name']] ? 'checked="checked"' : '')
                    . ' value="' . $option_value . '">'
                    . '<label for="' . $this->radio_counter . '_' . $option_value . '">' . $option . '</label>';
        }
        $this->buildValidation('radio', $attributes['name'], false, false, $attributes['options']);
        $this->radio_counter++;
    }

    public function addCheckboxInput($attributes) {
        $this->output[$attributes['name'] . '_error'] = null;
        if ($attributes['label_text']) {
            $this->output[$attributes['name'] . '_label'] = '<label class="' . $attributes['class'] . '">'
                    . '' . $attributes['label_text'] . '</label>';
        }
        $this->output[$attributes['name'] . '_checkbox'] = '';
        foreach ($attributes['options'] as $option_value => $option) {
            $this->output[$attributes['name'] . '_checkbox'] .=
                    '<input type="checkbox"'
                    . ' id="' . $this->checkbox_counter . '_' . $option_value . '"'
                    . ' name="' . $attributes['name'] . ($attributes['multiselect'] == true ? '[]' : '') . '" '
                    . ' '
                    . ' value="' . $option_value . '">'
                    . '<label for="' . $this->checkbox_counter . '_' . $option_value . '" class="' . $attributes['class'] . '">'
                    . '' . $option . '</label>';
        }
    }

    public function addSelectListInput($attributes) {
        $class_temp = $attributes['class'];
        $this->output[$attributes['name'] . '_error'] = null;
        if ($attributes['label_text']) {
            $this->output[$attributes['name'] . '_label'] = '<label class="' . $attributes['label_class'] . '">'
                    . '' . $attributes['label_text'] . '</label>';
        }
        $this->output[$attributes['name'] . '_selectlist'] = ''
                . '<select name="' . $attributes['name'] . ($attributes['multiselect'] ? '[]' : '') . '" ' . ($attributes['multiselect'] ? "multiple=\"multiple\"" : "")
                . ($attributes['class'] ? 'class="' . $class_temp . '"' : '') . '>';
        foreach ($attributes['options'] as $option_value => $option) {
            $this->output[$attributes['name'] . '_selectlist'] .=
                    '<option ' . (isset($this->data[$attributes['name']]) && in_array($option_value, $this->data[$attributes['name']]) ? 'selected="selected"' : '') . ' value="' . $option_value . '">' . $option . '</option>';
        }
        $this->output[$attributes['name'] . '_selectlist'] .= ''
                . '</select>';
        $this->buildValidation(
                'selectlist', $attributes['name'], false, $attributes['required'], $attributes['options'], $attributes['multiselect']
        );
        $this->checkbox_counter++;
    }

    public function addTextareaInput($attributes) {
        $this->output[$attributes['name'] . '_error'] = null;
        if ($attributes['label_text']) {
            $this->output[$attributes['name'] . '_label'] = ' <label '
                    . 'class="' . $attributes['label_class'] . '" '
                    . ' for="' . $attributes['id'] . '">'
                    . $attributes['label_text']
                    . '</label>';
        }
        $pattern_temp = 'pattern="' . $attributes['pattern'] . '"';
        $this->output[$attributes['name'] . '_input'] = '<textarea '
                . 'class="' . $attributes['class'] . '"'
                . ' name="' . $attributes['name'] . '"'
                . (isset($attributes['rows']) ? ' rows=' . $attributes['rows'] : '')
                . ($attributes['id'] ? ' id="' . $attributes['id'] . '"' : '')
                . ($attributes['required'] == TRUE ? " requred=\"requred\"" : "")
                . ' placeholder="' . $attributes['placeholder'] . '" '
                . ($attributes['pattern'] != false ? $pattern_temp : "")
                . ' type="' . $attributes['type'] . '">'
                . (isset($this->data[$attributes['name']]) ? htmlentities($this->data[$attributes['name']]) :
                        (isset($_POST[$attributes['name']]) && $attributes['type'] != 'password' ? htmlentities($_POST[$attributes['name']]) :
                                (isset($attributes['default_value']) && isset($attributes['default_value'][0]) ? $attributes['default_value'][0] : "")))
                . '</textarea>';
        $this->buildValidation(
                $attributes['type'], $attributes['name'], $attributes['pattern'], $attributes['required'], false, $attributes['validator']
        );
    }

    public function addTextInput($attributes) {
        $this->output[$attributes['name'] . '_error'] = null;
        if ($attributes['label_text']) {
            $this->output[$attributes['name'] . '_label'] = ' <label '
                    . 'class="' . $attributes['label_class'] . '" '
                    . ' for="' . $attributes['id'] . '">'
                    . $attributes['label_text']
                    . '</label>';
        }
        $pattern_temp = 'pattern="' . $attributes['pattern'] . '"';
        $this->output[$attributes['name'] . '_input'] = '<input '
                . 'class="' . $attributes['class'] . '"'
                . ' name="' . $attributes['name'] . '"'
                . ' value="' .
                (isset($this->data[$attributes['name']]) ? htmlentities($this->data[$attributes['name']]) :
                        (isset($_POST[$attributes['name']]) && $attributes['type'] != 'password' ? htmlentities($_POST[$attributes['name']]) :
                                (isset($attributes['default_value']) && isset($attributes['default_value'][0]) ? $attributes['default_value'][0] : ""))) . '"'
                . ($attributes['id'] ? ' id="' . $attributes['id'] . '"' : '')
                . ($attributes['required'] == TRUE ? " requred=\"requred\"" : "")
                . ' placeholder="' . $attributes['placeholder'] . '" '
                . ($attributes['pattern'] != false ? $pattern_temp : "")
                . ' type="' . $attributes['type'] . '">';
        $this->buildValidation(
                $attributes['type'], $attributes['name'], $attributes['pattern'], $attributes['required'], false, $attributes['validator']
        );
    }

    public function addSubmit($submit_name, $value, $class = '', $onclick = '') {
        $this->output[$submit_name . '_submit'] = '<input type="submit" class="' . $class . '" name="' . $submit_name . '"';
        $this->output[$submit_name . '_submit'].= ' value="' . $value . '">';
    }

    public function render() {
        //var_dump($this->data);
        //var_dump($this->output);//exit;
        //var_dump($this->validator);exit;
        $this->output['_token'] = '<input type="hidden" name="_token" value="FEFEFWFDSFV">';
        $this->output['close'] = '</form>';
        return $this->output;
    }

    public function buildValidation($type, $form_name, $pattern, $required, $options = false, $validator = false, $multipleData = false) {
        switch ($type) {
            case 'text':
            case 'password':
            case 'textarea':
                $this->validator[$form_name] = ['pattern' => $pattern, 'required' => $required, 'validator' => $validator];
                break;
            case 'radio';
                $this->validator[$form_name] = ['option_values' => $options, 'validator' => [], 'required' => true];
                break;
            case 'checkbox';
                $this->validator[$form_name] = ['option_values' => $options, 'required' => $required, 'validator' => []];
                break;
            case 'selectlist';
                $this->validator[$form_name] = ['allowed_option_values' => $options, 'required' => $required, 'validator' => []];
                break;
            case 'email':
                $this->validator[$form_name] = ['email' => 'email', 'required' => $required, 'validator' => []];
                break;
            default:
                break;
        }
    }

    public function isValid() {
        //var_dump($this->validator);exit;
        $valid = true;
        foreach ($this->validator as $form_name => $value) {
            if (isset($_POST[$form_name])) {
                if (is_array($_POST[$form_name])) {
                    foreach ($_POST[$form_name] as $key => $formValue) {
                        $_POST[$form_name[$key]] = trim($formValue);
                    }
                } else {
                    $_POST[$form_name] = trim($_POST[$form_name]);
                }
            }
            foreach ($value['validator'] as $validator_type => $validator_value) {
                if ($validator_type == 'regex' &&
                        $validator_value != false &&
                        !preg_match($validator_value, $_POST[$form_name])) {
                    //Text input field preg match validation
                    $valid = false;
                    $this->output[$form_name . '_error'] = 'Érvénytelen karaktereket adott meg.';
                } else if ($validator_type == 'min_length' && strlen($_POST[$form_name]) < $validator_value) {
                    $valid = false;
                    $this->output[$form_name . '_error'] = 'A megadott karakterek száma kevesebb mint ' . $validator_value . '';
                } else if ($validator_type == 'max_length' && strlen($_POST[$form_name]) > $validator_value) {
                    $valid = false;
                    $this->output[$form_name . '_error'] = 'A megadott karakterek száma több mint ' . $validator_value . '';
                } else if ($validator_type == 'same_as' && $_POST[$validator_value] != $_POST[$form_name]) {
                    $this->output[$validator_value . '_error'] = 'A megadott jelszavak nem eggyeznek meg' . $validator_value . '';
                    $valid = false;
                }
            }
            if ($value['required'] == true && empty($_POST[$form_name])) {
                $valid = false;
                $this->output[$form_name . '_error'] = 'Ennek a mezőnek a kitöltése kötelező.';
            }
            if (isset($value['option_values'])) {
                //Radio input validation
                if (!isset($_POST[$form_name])) {
                    if ($value['required']) {
                        $this->output[$form_name . '_error'] = 'Folytatáshoz el kell fogadnia.';
                    } else {
                        $this->output[$form_name . '_error'] = 'Válasszon egy lehetőséget.';
                    }
                    $valid = false;
                } else if (!array_key_exists($_POST[$form_name], $value['option_values'])) {
                    //Only date values are accepted
                    $valid = false;
                    $this->output[$form_name . '_error'] = 'Érvénytelen lehetőséget választott ki.';
                }
            } else if (isset($value['email'])) {
                if (!filter_var($_POST[$form_name], FILTER_VALIDATE_EMAIL)) {
                    $this->output[$form_name . '_error'] .= "Invalid email format";
                    $valid = false;
                }
            } else if (isset($value['allowed_option_values'])) {
                if (isset($_POST[$form_name]) && is_array($_POST[$form_name])) {
                    foreach ($_POST[$form_name] as $formValue) {
                        if (array_key_exists($formValue, $value['allowed_option_values'])) {
                            $this->output[$form_name . '_error'] = 'Érvénytelen lehetőséget választott ki.(Select list)';
                            break;
                        }
                    }
                }
            }
        }
        return $valid;
    }

    /**
     * SetData function
     * @param type $formData array || string
     * ex: $formData = [
      'dataNames' => [
      'id', 'active'
      ],
      'langDataNames' => [
      'title',
      'lead',
      'text',
      'keywords',
      'sef',
      ]
      ];
     * ContentController
     * dataNames content table, langDataNames content_lang table
     * ex:input name
     * @param type $values
     */
    public function setData($formData, $values, $multiForm = false, $multilanguage = false) {
        if (!is_array($formData)) {
            if($multilanguage){
                if(isset($values[0])){
                    foreach ($values[0] as $key => $values){
                        $this->data[$key] = $values;
                    }
                }
            } else {
                $this->data[$formData] = $values;
            }
        } else {
            $session = new SessionManager();
            foreach ($formData['dataNames'] as $data) {
                $this->data[$data] = $values[0]->$data;
            }
            if ($multiForm) {
                foreach ($values as $key => $valueArray) {
                    foreach ($valueArray as $valueOfArrayElement) {
                        $lang_code = $session->get('languages')[$valueOfArrayElement->lang_id]->lang_code;
                        foreach ($formData['langDataNames'] as $data) {
                            $this->data[$lang_code . '_' . $data . '_' . $key] = $valueOfArrayElement->$data;
                        }
                    }
                }
                } else {
                    foreach ($values as $value) {
                        $lang_code = $session->get('languages')[$value->lang_id]->lang_code;
                        foreach ($formData['langDataNames'] as $data) {
                            $this->data[$lang_code . '_' . $data] = $value->$data;
                        }
                    }
                }
            }
        }
    }
    