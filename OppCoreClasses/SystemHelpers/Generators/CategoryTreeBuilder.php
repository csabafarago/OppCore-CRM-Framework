<?php

namespace OppCoreClasses\SystemHelpers\Generators;

class CategoryTreeBuilder {

    private $last_root_name;
    private $last_down1_name;
    private $category_list;

    public function buildCategoryTree($category_list) {
        $output = '<ul>';
        $this->category_list = $category_list;
        foreach ($this->category_list as $category) {
            if ($this->last_root_name != $category['root_name']) {
                $this->last_root_name = $category['root_name'];
                $output .= '<li>' . $category['root_name'] . '</li>'. ($category['down1_name'] != ''? $this->drawFirstLevel() : '');
            }
            $this->last_root_name = $category['root_name'];
        }
        $output .= '</ul>';
        return $output;
    }

    private function drawFirstLevel() {
        $output = '<ul>';
        foreach ($this->category_list as $category) {
            if ($category['root_name'] == $this->last_root_name) {
                if ($this->last_down1_name != $category['down1_name']) {
                    $this->last_down1_name = $category['down1_name'];
                    $output .= '<li>' . $category['down1_name'] . '</li>'. ($category['down2_name'] != ''? $this->drawSecondLevel() :'');
                }
                $this->last_down1_name = $category['down1_name'];
                
            }
        }
        $output .= '</ul>';
        return $output;
    }

    private function drawSecondLevel() {
        $output = '<ul>';
        foreach ($this->category_list as $category) {
            if ($category['root_name'] == $this->last_root_name &&
                    $category['down1_name'] == $this->last_down1_name) {
                    $output .= '<li>' . $category['down2_name'] . '</li>';
            }
        }
        $output .= '</ul>';
        return $output;
    }

//    public function buildCategoryTree($category_list){
//        $output = '<ul>';
//        $lastRootItem = '';
//        $first2ndLevel = true;
//        $lastDown1Name = '';
//        $lastDown2Name = '';
//        $down1IsOpen = false;
//        $down2IsOpen = false;
//        foreach ($category_list as $category){
//            if($lastRootItem != $category['root_name']){
//                $output .= ($down2IsOpen ? '</ul></li>':'')
//                        . ($down1IsOpen ? '</ul></li>':'').'<li class="level_1">'.$category['root_name']
//                        . ($category['down1_name'] == null ? '</li>': '');
//                $down1IsOpen = false;
//            }
//            if($category['down1_name'] != null && $lastDown1Name != $category['down1_name']){
//                if($lastRootItem != $category['root_name']){
//                    $output .= '<ul>';
//                    $down1IsOpen = true;
//                }
//                $output .= ($down2IsOpen ? '</ul></li>':'');
//                $output .= '<li class="level_2">'.$category['down1_name']
//                        . ($category['down2_name'] == null ? '</li>': '');
//                $down2IsOpen = false;
//            }
//            if($category['down2_name'] != null){
//                if($category['down1_name'] != $lastDown1Name){
//                    $output .= '<ul>';
//                    $down2IsOpen = true;
//                }
//                $output .= '<li class="level_3">'.$category['down2_name'].'</li>';
//            }
//            $lastDown1Name = $category['down1_name'];
//            $lastRootItem = $category['root_name'];
//        }
//        $output .= '</ul>';
//        echo $output;
//        var_dump($output);
//        return $output;
//    }
}
