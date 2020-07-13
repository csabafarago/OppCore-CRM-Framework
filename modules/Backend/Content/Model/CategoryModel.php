<?php

namespace modules\backend\Content\Model;

use PDO;
use OppCoreClasses\Helper;
use OppCoreClasses\Model\Model;

class CategoryModel{
    
    public function insertCategory($data){
        $connection = Model::getInstance();
        if($data['parent_id'] == ''){
            $data['parent_id'] = 0;
        } else {
            $data['parent_id'] = (int) $data['parent_id'];
        }
        $data['active'] = (int) $data['active'];
        $user_group = 1;
        $statement = $connection->dbh->prepare('INSERT INTO `category` '
                . '(`parent_id`,'
                . ' `active`)'
                . ' VALUES ('
                . ' :parent_id, '
                . ' :active)'
        );
        $statement->bindParam(':parent_id', $data['parent_id'], PDO::PARAM_INT);        
        $statement->bindParam(':active', $data['active'], PDO::PARAM_INT);
        if ($statement->execute()){
            $categoryId = $connection->dbh->lastInsertId();
            $languages = Helper::load('config')['site_config']['languages'];
            $fields = [
                'lang_id',
                'category_name',
                'sef',
            ];
            $sql = 'INSERT INTO `category_lang` ';
            foreach($languages as $language){
                $sql_fields = '`category_id`';
                $sqlBinds = ':category_id';
                foreach($fields as $field){
                    if($sql_fields != ''){
                        $sql_fields .= ', ';
                    }
                    $sql_fields .= '`'. $field .'`';
                    if($sqlBinds != ''){
                        $sqlBinds .= ', ';
                    }
                    $sqlBinds .= ':'.$field;
                }
                $statement = $connection->dbh->prepare($sql. '('.$sql_fields .') VALUES ('.$sqlBinds .')');
                foreach($fields as $field){
                    $statement->bindParam(':'.$field, $data[$language.'_'.$field], PDO::PARAM_INT);        
                }
                $statement->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
                if(!$statement->execute()){
                    return [
                        'result' => false,
                        'message' => 'Kategória (lang) mentése sikertelen.',
                    ];  
                }
            }
            return [
                'result' => true,
                'message' => 'Kategória mentése sikerült.',
            ];  
        } else {
            return [
                'result' => false,
                'message' => 'Kategória mentése sikertelen.',
            ];
        }
    }
    
    public function updateCategory($data){
        $connection = Model::getInstance();
        if($data['parent_id'] == ''){
            $data['parent_id'] = 0;
        } else {
            $data['parent_id'] = (int) $data['parent_id'];
        }
        $data['active'] = (int) $data['active'];
        $statement = $connection->dbh->prepare(
                'UPDATE `category` SET `parent_id`=:parent_id,`active`=:active WHERE `id` = :id '
        );
        $statement->bindParam(':parent_id', $data['parent_id'], PDO::PARAM_INT);        
        $statement->bindParam(':active', $data['active'], PDO::PARAM_INT);
        $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);
        if (!$statement->execute()) {
            return [
                'result' => false,
                'message' => 'Kategória módosítása sikertelen.',
            ];
        }
        $fields = [
            'category_name',
            'sef',
        ];
        $languages = Helper::load('config')['site_config']['languages'];
        $sql = 'UPDATE `category_lang` SET ';
        foreach ($languages as $language) {
            $sql_fields = '';
            foreach ($fields as $field) {
                if ($sql_fields != ''? $sql_fields .=',':'');
                $sql_fields .= '`'.$field . '` = :'.$field.' ';
            }
            $statement = $connection->dbh->prepare($sql . $sql_fields . 'WHERE `category_id` = :category_id AND `lang_id` = :lang_id');
            foreach ($fields as $field) {
                $statement->bindParam(':' . $field, $data[$language . '_' . $field], PDO::PARAM_STR);
            }
            $statement->bindParam(':category_id', $data['id'], PDO::PARAM_INT);
            $statement->bindParam(':lang_id', $data[$language . '_lang_id'], PDO::PARAM_INT);
            if (!$statement->execute()) {
                return [
                    'result' => false,
                    'message' => 'Kategória (lang) mentése sikertelen.',
                ];
            }
        }
        return [
            'result' => true,
            'message' => 'Kategória módosítása sikeres.',
        ];
    }
    
    public function listCategories($lang_id){
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('SELECT '
                . ' `category_lang1`.`category_id`,'
                . ' `category_lang1`.`category_name`,'
                . ' `category`.`parent_id`,'
                . ' `category_lang2`.`category_name` AS `parent_name`,'
                . ' `category`.`active` FROM `category`'
                . ' LEFT JOIN `category_lang` AS `category_lang1` ON `category`.`id` = `category_lang1`.`category_id`'
                . ' AND `category_lang1`.`lang_id` = :lang_id' 
                . ' LEFT JOIN `category_lang` AS `category_lang2` ON `category`.`parent_id` = `category_lang2`.`category_id`'
                . ' AND `category_lang2`.`lang_id` = :lang_id' 
                );
        $statement->bindParam(':lang_id', $lang_id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return [
                'result' => true,
                'data' => $statement->fetchAll(PDO::FETCH_OBJ)
            ];
        } else {        
            var_dump($statement->errorInfo());
            var_dump($statement->errorCode());exit;
            return ['result' => false];
        }
    }

    public function deleteCategory($categoryId){
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('DELETE FROM `category_lang`'
                . ' WHERE `category_id` = :category_id');
        $statement->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        $statement_2 = $connection->dbh->prepare('DELETE FROM `category`'
                . ' WHERE `id` = :category_id');
        $statement_2->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        if ($statement->execute() && $statement_2->execute()) {
            return [
                'result' => true,
            ];
        } else {        
            var_dump($statement->errorInfo());
            var_dump($statement->errorCode());
            return ['result' => false];
        }
    }
    
    public function getCategory($categoryId, $languages){
        $languageIds = null;
        foreach ($languages as $language){
            ($languageIds != null ? $languageIds.=',':'');
            $languageIds .= $language->lang_id;
        }
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('
            SELECT 
                    c.id, c.parent_id, c.active, cl.lang_id, cl.category_name, cl.sef
                FROM
                    category AS c
                        LEFT JOIN
                    category_lang cl ON c.id = cl.category_id AND cl.lang_id IN ('.$languageIds.')
                    WHERE c.id = :category_id');
        $statement->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
        if ($statement->execute()) {
            return [
                'result' => true,
                'data' => $statement->fetchAll(PDO::FETCH_OBJ)
            ];
        } else {        
            var_dump($statement->errorInfo());
            var_dump($statement->errorCode());exit;
            return ['result' => false];
        }
    }

}
