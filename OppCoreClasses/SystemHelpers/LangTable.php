<?php

namespace OppCoreClasses\SystemHelpers;

use OppCoreClasses\Model\Model;
use OppCoreClasses\Helper;
use OppCoreClasses\Session\SessionManager;
use PDO;
use Exception;

class LangTable {


    public function getLanguages() {
        $languages = Helper::load('config')['site_config']['languages'];
        $result = [];
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('SELECT `lang_name`, `lang_id`,`lang_code` FROM `lang`  WHERE `lang_code` IN (\'' . implode('\',\'', $languages) . '\')');
        if ($statement->execute()) {
            $rows = $statement->fetchAll(PDO::FETCH_OBJ);
            if ($statement->rowCount() > 0) {
                foreach ($rows as $row){
                    $result[$row->lang_id] = $row;
                }
                return $result;
            } else {
                throw new Exception("Import lang_data.sql from db folder!");
                return ['result' => false];
            }
        }
    }
    
    public function getLangId(){
        $langId = new SessionManager();
        $connection = Model::getInstance();
        $langId = $langId->get('lang');
        $statement = $connection->dbh->prepare('SELECT `lang_id` FROM `lang`'
                . ' WHERE `lang_code` = :lang_id');
        $statement->bindParam(':lang_id', $langId, PDO::PARAM_INT);
        if ($statement->execute()) {
            $row = $statement->fetch(PDO::FETCH_OBJ);
            if ($statement->rowCount() > 0) {
                return $row->lang_id;
            } else {
                throw new Exception("Import lang_data.sql from db folder!");
            }
        }
        throw new Exception("Import lang_data.sql from db folder!");
    }
}
