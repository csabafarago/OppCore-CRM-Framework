<?php

namespace modules\Backend\Authentication\Model;

use OppCoreClasses\Model\Model;
use PDO;
use OppCoreClasses\Helper;

class UserModel {

    public function registerUser($data) {
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('INSERT INTO `user`'
                . '(`username`,'
                . ' `first_name`,'
                . ' `last_name`,'
                . ' `email`,'
                . ' `password`,'
                . ' `active`,'
                . ' `registered_date`,'
                . ' `deleted_date`,'
                . ' `permissions`)'
                . ' VALUES ('
                . ':username,'
                . ':first_name,'
                . ':last_name,'
                . ':email,'
                . 'sha1(:password),'
                . '0,'
                . ':registered_date,'
                . 'NULL,'
                . ':permissions)'
        );
        $statement->bindParam(':username', $data['username'], PDO::PARAM_INT);
        $statement->bindParam(':first_name', $data['first_name'], PDO::PARAM_INT);
        $statement->bindParam(':last_name', $data['last_name'], PDO::PARAM_INT);
        $statement->bindParam(':email', $data['email'], PDO::PARAM_INT);
        $statement->bindParam(':password', $data['password'], PDO::PARAM_INT);
        $statement->bindParam(':registered_date', $current_time, PDO::PARAM_INT);
        $statement->bindParam(':permissions', $data['permissions'], PDO::PARAM_INT);
        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function authenticationUser($data){
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('SELECT `id`, concat(`last_name`, " ", `first_name`) as `username`,`email`, `password`,`user_groups`, `admin_login` FROM `user`'
                .' WHERE '
                . '`email` = :email AND'
                . '`password` = sha1(:password) AND'
                . '`admin_login` = 1'
        );

        $statement->bindParam(':email', $data['email'], PDO::PARAM_STR);
        $statement->bindParam(':password', $data['password'], PDO::PARAM_STR);
        if ($statement->execute()) {
            $row = $statement->fetch(PDO::FETCH_OBJ);
                if($statement->rowCount() > 0){
                    unset($row->email);
                    unset($row->password);
                    return [
                        'result' => true,
                        'user_data' => $row
                    ];              
                } else {
                return ['result' => false];
            } 
        }
    }

    public function getUsers() {

        $sql = "select * from user";

        $core = Model::getInstance();
        $stmt = $core->dbh->prepare($sql);

        if ($stmt->execute()) {
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }
    }

}
