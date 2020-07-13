<?php

spl_autoload_register('myAutoloader');

function myAutoloader($className)
{
    include '../'.str_replace('\\', '/', $className).'.php';
}

