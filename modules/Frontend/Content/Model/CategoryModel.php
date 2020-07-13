<?php
namespace modules\Frontend\Content\Model;

use OppCoreClasses\Model\Model;
use PDO;

class CategoryModel {

    public function getCategoriesList($lang_id) {
        $connection = Model::getInstance();
        $statement = $connection->dbh->prepare(
                'SELECT 
                    lang1.category_name AS root_name,
                    lang2.category_name AS down1_name,
                    lang3.category_name AS down2_name
                FROM
                    category AS root
                        LEFT JOIN 
                    category_lang AS lang1
                        ON root.id = lang1.category_id AND lang1.lang_id = :lang_id
                        LEFT JOIN
                    category AS down1 
                        ON down1.parent_id = root.id
                    LEFT JOIN 
                    category_lang AS lang2
                        ON down1.id = lang2.category_id AND lang2.lang_id = :lang_id
                    LEFT JOIN
                    category AS down2
                        ON down2.parent_id = down1.id
                    LEFT JOIN 
                    category_lang AS lang3
                        ON down2.id = lang3.category_id AND lang3.lang_id = :lang_id
                WHERE
                    root.parent_id = 0
                ORDER BY root_name, down1_name, down2_name');
        $statement->bindParam(':lang_id', $lang_id, PDO::PARAM_INT);
        if ($statement->execute()) {
            return [
                'result' => true,
                'data' => $statement->fetchAll(PDO::FETCH_ASSOC)
            ];
        } else {
            return ['result' => false];
        }
    }

}
