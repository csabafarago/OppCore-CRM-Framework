<?php

namespace OppCoreClasses\Model;

use \OppCoreClasses\Helper;
use \PDO;
use \PDOException;

class Model {

    public $dbh; // handle of the db connection
    private static $instance;

    private function __construct() {
        try {
            $config = Helper::load('config')['mysql_config'][Helper::$environment];
            // var_dump($config['batabase']);
            // building data source name from config
            $dsn = 'mysql:host=' . "localhost" .
                    ';dbname=' . $config['batabase'] .
                    ';port=' . '3306' .
                    ';connect_timeout=15';
            // getting DB user from config
            $user = $config['username'];
            // getting DB password from config
            $password = $config['password'];

            $this->dbh = new PDO($dsn, $user, $password);
            $this->dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->dbh->exec("set names utf8");
        } catch (PDOException $ex) {
            include_once __DIR__ . '/../error_templates/500-error.php';
            die('Database error');
        }
    }

    public static function getInstance($query_key = '') {
        echo $query_key;
        if (!isset(self::$instance)) {
            $object = __CLASS__;
            self::$instance = new $object;
        }
        return self::$instance;
    }

    // others global functions
}
