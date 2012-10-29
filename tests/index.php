<?php
function myLoader($class)
{
    $class = str_replace('Frost','',$class);
    $class = ltrim($class,'\\');
    $fileName = '';
    $namespace = '';
    if($lastNsPos = strripos($class,'\\')) {
        $namespace = substr($class,0,$lastNsPos);
        $class = substr($class, $lastNsPos + 1);
        $fileName = str_replace('\\',DIRECTORY_SEPARATOR,$namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('\\',DIRECTORY_SEPARATOR,$class) . '.php';
    require $fileName;
}

spl_autoload_register('myLoader');