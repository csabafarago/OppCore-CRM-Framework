<?php

namespace modules\Backend\Content\Model;

use OppCoreClasses\Model\Model;
use PDO;

class ContentModel {

    public function getContents($lang_id) {
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('
            SELECT `content`.`id`,
                `content`.`created_date`,
                `content`.`modified_date`,
                `created_by_user`.`first_name` AS c_first_name,
                `created_by_user`.`last_name` AS c_last_name,
                `modified_by_user`.`first_name` AS m_first_name,
                `modified_by_user`.`last_name` AS m_last_name,
                `content`.`modified_by`,
                `content`.`active`,
                `content_lang`.`title`
            FROM `content`
            LEFT JOIN `content_lang` ON `content_lang`.`content_id` = `content`.`id` AND `content_lang`.`lang_id` = :lang_id 
            LEFT JOIN `user` AS `created_by_user` ON `created_by_user`.`id` = `content`.`created_by` 
            LEFT JOIN `user` AS `modified_by_user` ON `modified_by_user`.`id` = `content`.`modified_by`
            WHERE `content`.`deleted_by` IS NULL 
            AND `content`.`deleted_date` IS NULL
            ORDER BY `content`.`id` DESC'
        );
        $statement->bindParam(':lang_id', $lang_id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return [
                'result' => true,
                'data' => $statement->fetchAll(PDO::FETCH_OBJ)
            ];
        } else {
            var_dump($statement->errorInfo());
            var_dump($statement->errorCode());
            exit;
            return ['result' => false];
        }
    }

    public function insertContent($data, $user_id, $languages) {
        $connection = Model::getInstance();
        $data['active'] = (int) $data['active'];
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $statement = $connection->dbh->prepare('INSERT INTO `content`'
                . '(
                `created_date`,
                `modified_date`,
                `deleted_date`,
                `created_by`,
                `modified_by`,
                `active`)'
                . ' VALUES ('
                . ' :created_date, '
                . ' :modified_date, '
                . ' :deleted_date, '
                . ' :created_by, '
                . ' :modified_by,'
                . ' :active)'
        );
        $statement->bindParam(':created_date', $current_time, PDO::PARAM_INT);
        $statement->bindValue(':modified_date', NULL, PDO::PARAM_INT);
        $statement->bindValue(':deleted_date', NULL, PDO::PARAM_INT);
        $statement->bindParam(':created_by', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':modified_by', NULL, PDO::PARAM_INT);
        $statement->bindParam(':active', $data['active'], PDO::PARAM_INT);
        if ($statement->execute()) {
            $contentId = $connection->dbh->lastInsertId();
            $fields = [
                'lang_id',
                'title',
                'lead',
                'text',
                'keywords',
                'sef',
            ];
            $sql = 'INSERT INTO `content_lang` ';
            foreach ($languages as $language) {
                $sql_fields = '`content_id`';
                $sqlBinds = ':content_id';
                foreach ($fields as $field) {
                    if ($sql_fields != '') {
                        $sql_fields .= ', ';
                    }
                    $sql_fields .= '`' . $field . '`';
                    if ($sqlBinds != '') {
                        $sqlBinds .= ', ';
                    }
                    $sqlBinds .= ':' . $field;
                }
                $statement = $connection->dbh->prepare($sql . '(' . $sql_fields . ') VALUES (' . $sqlBinds . ')');
                foreach ($fields as $field) {
                    $statement->bindParam(':' . $field, $data[$language->lang_code . '_' . $field], PDO::PARAM_INT);
                }
                $statement->bindParam(':content_id', $contentId, PDO::PARAM_INT);
                if (!$statement->execute()) {
                    var_dump($statement->errorInfo());
                    var_dump($statement->errorCode());
                    die('Something went wrong');
                    return [
                        'result' => false,
                        'message' => 'Tartalomgória (lang) mentése sikertelen.',
                    ];
                }
            }
            if (isset($data['categories']) && is_array($data['categories'])) {
                $statement = $connection->dbh->prepare('INSERT INTO `content_category`'
                        . '(
                            `category_id`,
                            `content_id`)'
                        . ' VALUES ('
                        . ' :category_id, '
                        . ' :content_id)'
                );
                $statement->bindParam(':content_id', $contentId, PDO::PARAM_INT);
                foreach ($data['categories'] as $categoryId) {
                    $statement->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
                    if (!$statement->execute()) {
                        die('Something went wrong');
                    }
                }
            }
            return [
                'result' => true,
                'message' => 'Tartalom mentése sikerült.',
            ];
        } else {
            return [
                'result' => false,
                'message' => 'Tartalom mentése sikertelen.',
            ];
        }
    }
    
    public function delete($id, $user_id) {
        $connection = Model::getInstance();
        $date = strtotime(date('Y-m-d h:i:s'));
        $statement = $connection->dbh->prepare(
            'UPDATE `content` SET `deleted_by`=:deleted_by, `deleted_date`=:deleted_date WHERE `id` = :id '
        );
        $statement->bindParam(':deleted_date', $date, PDO::PARAM_INT);
        $statement->bindParam(':deleted_by', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        if (!$statement->execute()) {
            return [
                'result' => true,
                'message' => 'Törlés sikeres',
            ];
        }
        return [
            'result' => false,
            'message' => 'Sikertelen törlés',
        ];
    }

    public function getContent($id, $languages) {
        $languageIds = null;
        foreach ($languages as $language) {
            ($languageIds != null ? $languageIds.=',' : '');
            $languageIds .= $language->lang_id;
        }
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('
            SELECT 
                    c.id, c.active, cl.lang_id, cl.title, cl.lead, cl.text, cl.keywords, cl.sef
                FROM
                    content AS c
                        LEFT JOIN
                    content_lang cl ON c.id = cl.content_id AND cl.lang_id IN (' . $languageIds . ')
                    WHERE c.id = :id');
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $getCategories = $connection->dbh->prepare('
            SELECT 
                    `category_id`
                FROM
                    `content_category`
                    WHERE `content_id` = :content_id');
            $getCategories->bindParam(':content_id', $id, PDO::PARAM_INT);
            if ($getCategories->execute()) {
                return [
                    'result' => true,
                    'data' => $statement->fetchAll(PDO::FETCH_OBJ),
                    'categories' => $getCategories->fetchAll(PDO::FETCH_COLUMN, 0)
                ];
            } else {
                die('Something went wrong');
            }
        } else {
            exit;
            return ['result' => false];
        }
    }

    public function updateContent($data, $user_id, $languages) {
        $connection = Model::getInstance();
        $data['active'] = (int) $data['active'];
        $current_time = strtotime(date('Y-m-d h:i:s'));
        $statement = $connection->dbh->prepare(
                'UPDATE `content` SET'
                . ' `modified_date`=:modified_date,'
                . ' `modified_by`=:modified_by,'
                . ' `lead_image`=:lead_image,'
                . ' `active`=:active'
                . ' WHERE `id` = :id '
        );
        $statement->bindParam(':modified_date', $current_time, PDO::PARAM_INT);
        $statement->bindParam(':modified_by', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':lead_image', $data['lead_image'], PDO::PARAM_INT);
        $statement->bindParam(':active', $data['active'], PDO::PARAM_INT);
        $statement->bindParam(':id', $data['id'], PDO::PARAM_INT);
        if (!$statement->execute()) {
            return [
                'result' => false,
                'message' => 'Kategória módosítása sikertelen.',
            ];
        }

        $fields = [
            'title',
            'lead',
            'text',
            'sef',
            'keywords'
        ];
        $sql = 'UPDATE `content_lang` SET ';
        foreach ($languages as $language) {
            $sql_fields = '';
            $sqlBinds = ':content_id';
            foreach ($fields as $field) {
                if ($sql_fields != '' ? $sql_fields .=',' : '')
                    ;
                $sql_fields .= '`' . $field . '` = :' . $field . ' ';
            }
            $statement = $connection->dbh->prepare($sql . $sql_fields . 'WHERE `content_id` = :content_id AND `lang_id`= :lang_id;');
            foreach ($fields as $field) {
                $statement->bindParam(':' . $field, $data[$language->lang_code . '_' . $field], PDO::PARAM_STR);
            }
            $statement->bindParam(':lang_id', $data[$language->lang_code . '_lang_id'], PDO::PARAM_INT);
            $statement->bindParam(':content_id', $data['id'], PDO::PARAM_INT);
            if (!$statement->execute()) {
                return [
                    'result' => false,
                    'message' => 'Tartalom (lang) mentése sikertelen.',
                ];
            }
        }
//A már rögzített kategóriák törlése minden esetben
        $statement = $connection->dbh->prepare('DELETE FROM `content_category`'
                . ' WHERE `content_id` = :content_id');
        $statement->bindParam(':content_id', $data['id'], PDO::PARAM_INT);
        if (!$statement->execute()) {
            die('Something went wrong');
        }
        //Ha jött a POST-ban kategória akkor azokat rögzítjük
        if (isset($data['categories']) && is_array($data['categories'])) {
            $statement = $connection->dbh->prepare('INSERT INTO `content_category`'
                    . '(
                        `category_id`,
                        `content_id`)'
                    . ' VALUES ('
                    . ' :category_id, '
                    . ' :content_id)'
            );
            $statement->bindParam(':content_id', $data['id'], PDO::PARAM_INT);
            foreach ($data['categories'] as $categoryId) {
                $statement->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
                if (!$statement->execute()) {
                    die('Something went wrong');
                }
            }
        }
        return [
            'result' => true,
            'message' => 'Tartalom módosítása sikeres.',
        ];
    }

}
