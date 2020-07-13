<?php
namespace modules\Frontend\Content\Model;

use OppCoreClasses\Model\Model;
use PDO;

class ContentModel {

    public function getContents() {

        $sql = "select * from user";
        $core = Model::getInstance();
        $stmt = $core->dbh->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchALL(PDO::FETCH_ASSOC);
        }
    }

    public function getContentBySef($contentSef, $lang_id) {
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare('SELECT 
                `content`.`id`,
                `content`.`created_date`,
                `content`.`modified_date`,
                `content`.`created_by`,
                `content`.`modified_by`,
                `content`.`lead_image`,
                `content_lang`.`title`,
                `content_lang`.`lead`,
                `content_lang`.`text`,
                `content_lang`.`keywords`
            FROM
                `content_lang`
                    LEFT JOIN
                `content` ON `content_lang`.`content_id` = `content`.`id`
                    AND `content_lang`.`sef` = :sef
                    AND `content_lang`.`lang_id` = :lang_id
            WHERE
                `content`.`active` = 1
                AND `content`.`deleted_date` IS NULL;
            ');
        $statement->bindParam(':sef', $contentSef, PDO::PARAM_INT);
        $statement->bindParam(':lang_id', $lang_id, PDO::PARAM_INT);
        if ($statement->execute()) {
            $contentData = $statement->fetch(PDO::FETCH_OBJ);
            $getCategories = $connection->dbh->prepare('SELECT 
                    `category_lang`.`category_name`,
                    `content_category`.`category_id`
                FROM
                    `content_category`
                        LEFT JOIN
                    `category_lang` ON `category_lang`.`category_id` = `content_category`.`category_id`
                        AND `category_lang`.`lang_id` = :lang_id
                WHERE
                    `content_category`.`content_id` = :content_id;');
            $getCategories->bindParam(':content_id', $contentData->id, PDO::PARAM_INT);
            $getCategories->bindParam(':lang_id', $lang_id, PDO::PARAM_INT);

            if ($getCategories->execute()) {
                if ($statement->rowCount() == 1) {
                    return [
                        'result' => true,
                        'contentData' => $contentData,
                        'categories' => $getCategories->fetchAll(PDO::FETCH_COLUMN, 0)
                    ];
                } else {
                    return [
                        'result' => false,
                  ];
                }
            } else {
                return [
                    'result' => false,
                ];
            }
        } else {
            return ['result' => false];
        }
    }

}
