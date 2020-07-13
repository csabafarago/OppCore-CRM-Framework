<?php

namespace modules\Frontend\Authentication\Model;

use PDO;
use OppCoreClasses\Helper;
use OppCoreClasses\Model\Model;

class UserModel{

    public function registerUser($data){
        $connection = Model::getInstance();
        //Check if username already exist in database
        $statement = $connection->dbh->prepare('SELECT `username` FROM `user`'
                .' WHERE '
                . '`username` = :username'
        );
       
        $statement->bindParam(':username', $data['username'], PDO::PARAM_STR);
        if ($statement->execute()) {
            if($statement->rowCount() > 0){
                return [
                    'message' => 'The username is already taken.',
                    'result' => false
                ];
            }
        }
        //Check if email address already exist or not in database
        $statement = $connection->dbh->prepare('SELECT `email` FROM `user`'
                .' WHERE '
                . '`email` = :email'
        );
       
        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        if ($statement->execute()) {
            if($statement->rowCount() > 0){
                return [
                    'message' => 'The email is already taken.',
                    'result' => false
                ];
            }
        }
        
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $statement = $connection->dbh->prepare('INSERT INTO `user`'
                . '(`username`,'
                . ' `first_name`,'
                . ' `last_name`,'
                . ' `email`,'
                . ' `password`,'
                . ' `active`,'
                . ' `registered_date`,'
                . ' `deleted_date`)'
                . ' VALUES ('
                . ':username,'
                . ':first_name,'
                . ':last_name,'
                . ':email,'
                . 'sha1(:password),'
                . '0,'
                . ':registered_date,'
                . 'NULL)'
        );
        $statement->bindParam(':username', $data['username'], PDO::PARAM_INT);
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_INT);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_INT);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_INT);
        $statement->bindParam(':password', $data['password'], PDO::PARAM_INT);
        $statement->bindParam(':registered_date', $current_time, PDO::PARAM_INT);
        if ($statement->execute()){
            return [
                'message' => 'Sikeres regisztráció',
                'result' => true,
            ];
        } else {
            return [
                'message' => 'Rendszer hiba történt, vegye fel a kapcsolatot a weboldal üzemeltetőjével..',
                'result' => false
            ];
        }
    }
    
    public function authenticationUser($data){
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('SELECT `username`, `password` FROM `user`'
                .' WHERE '
                . '`username` = :username AND'
                . '`password` = :password'
        );
        
        $login_field_type = $this->login_field_type = Helper::load('config')
            ['authentication_settings']
            ['login_field_type'];
        
        if($login_field_type == 'username'){
            $statement->bindParam(':username', $data['username'], PDO::PARAM_STR);
        } else if ($login_field_type == 'email'){
            $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        }
        $statement->bindParam(':password', $data['password'], PDO::PARAM_STR);
        if ($statement->execute()) {
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            return ['result' => true];
        } else {
            return ['result' => false];
        }
    }

    public function getUsers() {

        $sql = "select * from user";

        //try {
        $core = Model::getInstance();
        $stmt = $core->dbh->prepare($sql);
        //$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
            //$o = $stmt->fetch(PDO::FETC)
            // blablabla...
        }
        //var_dump($stmt->errorInfo());
        //var_dump($stmt->errorCode());
//    } catch (Exception $exc) {
//        echo $exc->getTraceAsString();
//    }
//    $sql = "select * from users where id = :id";
//    
//    try {
//        $core = Model::getInstance();
//        $stmt = $core->dbh->prepare($sql);
//        //$stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
//
//        if ($stmt->execute()) {
//            $o = $stmt->fetch(PDO::FETCH_OBJ);
//            // blablabla....
//        }
//        
//    } catch (Exception $exc) {
//        echo $exc->getTraceAsString();
//    }
    }

}
