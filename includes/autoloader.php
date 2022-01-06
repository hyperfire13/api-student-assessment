<?php
require 'config.php';
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $paths = array('classes/');
    $extension = ".php";
    $fullPath =  $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }
    require $fullPath;
}
?>