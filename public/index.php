<?php

//DEBUG conf
//$start = microtime(true);


header('Content-Type: text/html; charset=utf-8');
define('ROOT_DIR', __DIR__ . '/../');
define('DEVELOPER_MODE', true);
if (DEVELOPER_MODE) {
    ini_set('display_errors', 1);
    ini_set('xdebug.var_display_max_depth', 20);
    ini_set('xdebug.var_display_max_children', 256);
    ini_set('xdebug.var_display_max_data', 1024);
}
include('../OppCoreClasses/AutoLoader.php');

(new OppCoreClasses\System())->run();

//echo microtime(true) - $start;
