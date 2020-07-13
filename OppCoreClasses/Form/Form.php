<?php
//DEVELOP
namespace OppCoreClasses\Form;

class Form{
    
    private $method;
    private $_formElements = [];
    
    public function __construct($type) {
        $this->method = $method;
    }
    
    public function add($value){
        $element = new \stdClass();
        $element->type = $value;
        $this->_formElements[] = $element;
    }
    
}
