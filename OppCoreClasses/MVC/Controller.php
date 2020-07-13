<?php
namespace OppCoreClasses\MVC;

use ReflectionClass;
use OppCoreClasses\RouteHelper;
use OppCoreClasses\Helper;

class Controller{
    
    private $realPath = '';
    public $terminate = false;
    public $session;
    
    /*
     * Store real path of controller
     * Cut end of the path the Controller folder
     */
    
    public function __construct() {
        $this->realPath = substr(dirname((new ReflectionClass(static::class))->getFileName()), 0, -10);
        $this->session = new \OppCoreClasses\Session\SessionManager();
    }
    
    public function isPost(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }
        return false;
    }
    
    public function setTerminate($terminate){
        if($terminate == true){
            $this->terminate = true;
        }
    }
    
    public function getFullUrl(){
        $position_url = '';
        foreach (RouteHelper::$params as $value){
            $position_url .= '/'.$value;
        }
        return $position_url;
    }
    
    public function set404Page(){
        Helper::redirectToUrl(
            Helper::getURL(['error_404'], true)
        );
    }
    
}