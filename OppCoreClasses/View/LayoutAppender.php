<?php
namespace OppCoreClasses\View;

/**
 * Description of LayoutAppender
 *
 * @author csabi
 */
class LayoutAppender {

    public static $minifyCssName = 'style';
    public static $minifyJsName = 'js';
    public static $generatedDebugData = '';
    private static $appendHeadCssList = [];
    private static $appendFooterJsList = [];
    private static $appendInlineJs;
    static private $headTags = [];

    static function appendHeadCss($sources) {
         if(is_array($sources)){
            foreach ($sources as $source){
                self::$appendHeadCssList[] = $source;
            }
        } else {
            self::$appendHeadCssList[] = $sources;
        }
    }

    static function appendFooterJs($sources) {
        if(is_array($sources)){
            foreach ($sources as $source){
                self::$appendFooterJsList[] = $source;
            }
        } else {
            self::$appendFooterJsList[] = $sources;
        }
    }

    static function appendInlineFooterJs($sciptPath) {
        self::$appendInlineJs .= '<script>' . file_get_contents($sciptPath) . '</script>';
    }

    static function appendInlineScriptFooterJs($script) {
        self::$appendInlineJs .= '<script>' . $script . '</script>';
    }

    static function generateAppendedFooterJs() {
        $output = '';
        foreach (self::$appendFooterJsList as $script) {
            $output .= '<script src="' . $script . '"></script>' . "\n";
        }
        $output .= self::$appendInlineJs;
        return $output;
    }

    static function generateAppendedHeadCss() {
        $output = '';
        foreach (self::$appendHeadCssList as $style) {
            $output .= '<link rel="stylesheet" href="' . $style . '">' . "\n";
        }
        return $output;
    }
    
    /**
     * 
     * @param type $meta_name Title, Keywords, Author, Description
     * @param type $meta_value I'ts value
     */

    static function setMeta($meta_name, $meta_value) {
        switch ($meta_name) {
            case 'description';
                self::$headTags['description'] = '<meta name="description" content="' . $meta_value . '">';
                break;
            case 'keywords';
                self::$headTags['keywords'] = '<meta name="keywords" content="' . $meta_value . '">';
                break;
            case 'author';
                self::$headTags['author'] = '<meta name="author" content="' . $meta_value . '">';
                break;
            case 'title';
                self::$headTags['title'] = '<title>' . $meta_value . '</title>';
                break;
            default:
                exit;
        }
    }

    static function getMetaData() {
        $output = '';
        foreach (self::$headTags as $metatag) {
            $output .= $metatag;
        }
        return $output;
    }

    static function generateDebugData($data) {
        if(is_array($data)){
            self::$generatedDebugData = '<div class="debug-data10">';
            foreach ($data as $type => $values){
                self::buildDebugToolbar($type, $values);
            }
            self::$generatedDebugData .= '</div>';
        }
        self::appendHeadCss('/_templates/admin/debug.css');
        return self::$generatedDebugData;
    }
    
    private static function buildDebugToolbar($type, $values){
        if(!empty($values)){
            switch ($type) {
                case 'url';
                    self::$generatedDebugData .= '<div class="data"><div class="open">Urls</div><div class="closed">';
                    foreach ($values as $value) {
                        self::$generatedDebugData .= '<p><span class="orange">RAW_URL:</span> ' . $value['raw_url'] . '</p>';
                        self::$generatedDebugData .= '<p><span class="green">TRANSLATED_URL:</span> ' . $value['translated_url'] . '</p>';
                    }
                    self::$generatedDebugData .= '</div></div>';
                    break;
                case 'view';
                    self::$generatedDebugData .= '<div class="data"><div class="open">Views</div><div class="closed">';
                    foreach ($values as $value) {
                        self::$generatedDebugData .= '<p><span class="orange">Module:</span> ' . $value['module_data'] . '</p>';
                        self::$generatedDebugData .= '<p><span class="green">Missing view location:</span> ' . $value['view_location'] . '</p>';
                    }
                    self::$generatedDebugData .= '</div></div>';
                    break;
                default:
                    exit;
            }
        }
    }
    
}
