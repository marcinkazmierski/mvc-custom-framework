<?php

// global functions:
function t($string)
{
    // TODO: add translate function
    return htmlspecialchars($string);
}

function __autoload($class_name)
{
    $class_name = \app\core\Core::dirNameFilter($class_name);

    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    if (file_exists($class)) {
        require_once str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';
    }
}
