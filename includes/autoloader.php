<?php
echo dirname(__DIR__) . '\config.php';
require dirname(__DIR__) . '\config.php';
spl_autoload_register('classAutoLoader');

function classAutoLoader($className)
{
    $paths = array('classes/');
    $extension = ".php";
    $fullPath = dirname(__DIR__) . '/' . $className . $extension;

    if (!file_exists($fullPath)) {
        return false;
    }
    require $fullPath;
}
?>