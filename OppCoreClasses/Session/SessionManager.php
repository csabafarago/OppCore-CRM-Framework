<?php
namespace OppCoreClasses\Session;

class SessionManager{
    
    private static $_session_started = false;
    
    public function __construct() {
        self::startSession();
    }
    
    public static function startSession(){
        if(self::$_session_started == FALSE)
            {
                session_start();
                self::$_session_started = TRUE;
            }
    }

    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function get($name)
    {
        if (array_key_exists($name, $_SESSION)) {
            return $_SESSION[$name];
        }
    }
    
    public function removeSession($name){
        unset($_SESSION[$name]);
        return true;
    }

    public function setFlashMessage($key, $value)
    {
        $_SESSION['flash_'.$key] = $value;
        return true;
    }

    public function getFlashMessage($name)
    {
        if (array_key_exists('flash_'. $name, $_SESSION)) {
            $session_value = $_SESSION['flash_'.$name];
            unset($_SESSION['flash_'.$name]);
            return $session_value;
        }
    }
    
    public static function getVariable($name)
    {
        if (array_key_exists($name, $_SESSION)) {
            return $_SESSION[$name];
        }
    }
    
}