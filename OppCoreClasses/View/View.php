<?php
namespace OppCoreClasses\View;

class View
{
    protected $_file;
    protected $_data = [];
    
    /**
     * 
     * @param type $layout layout/admin_layout/sumodule load submodule's default view file
     * null loads it's default view file
     * @param type $layout_override load another view file instead of default
     */
    

    public function __construct($layout = null, $layout_override = null)
    {
        if($layout == null){
            $this->_file = \OppCoreClasses\Helper::load('load_view', $layout_override);
        } else if($layout == 'layout' || $layout == 'admin_layout'){
            $this->_file = \OppCoreClasses\Helper::load($layout, $layout_override);
        } else if($layout == 'mobile_layout'){
            $this->_file = \OppCoreClasses\Helper::load('mobile_layout', $layout_override);
        }
        
    }

    public function set($key, $value)
    {
        $this->_data[$key] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->_data)) {
            return $this->_data[$name];
        }
    }

    public function output()
    {
        if (!file_exists($this->_file))
        {
            die('View not found '. $this->_file);
        }
        ob_start();
        include($this->_file);
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}