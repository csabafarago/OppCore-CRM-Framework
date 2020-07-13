<?php

namespace OppCoreClasses\SystemHelpers\Generators;

class SelectListGenerator {

    private $last_root_name;
    private $last_down1_name;
    private $category_list;
    
    private $selectListarray = [];

    public function buildCategoryTree($category_list) {
        $this->category_list = $category_list;
        foreach ($this->category_list as $category) {
            if ($this->last_root_name != $category['root_name']) {
                $this->last_root_name = $category['root_name'];
                $this->selectListarray[$category['root_id']] = '&#10097;'.$category['root_name'];
                if ($category['down1_name'] != '') {
                    $this->drawFirstLevel();
                }
            } else if ($category['down1_name'] != '') {
                $this->drawFirstLevel();
            }
            $this->last_root_name = $category['root_name'];
        }
        return $this->selectListarray;
    }

    private function drawFirstLevel() {
        foreach ($this->category_list as $category) {
            if ($category['root_name'] == $this->last_root_name) {
                if ($this->last_down1_name != $category['down1_name']) {
                    $this->last_down1_name = $category['down1_name'];
                    $this->selectListarray[$category['down1_id']] = '&#x2758;&#10097;'.$category['down1_name'];
                    if ($category['down2_name'] != '') {
                        $this->drawSecondLevel();
                    }
                }
                $this->last_down1_name = $category['down1_name'];
                
            }
        }
        return true;
    }

    private function drawSecondLevel() {
        foreach ($this->category_list as $category) {
            if ($category['root_name'] == $this->last_root_name &&
                    $category['down1_name'] == $this->last_down1_name) {
                    $this->selectListarray[$category['down2_id']] = '&#x2758;&#x2758;&#10097;'.$category['down2_name'];
            }
        }
        return true;
    }
}
