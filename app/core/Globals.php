<?php

// global functions:
function t($string)
{ // TODO: add translate function
    return htmlspecialchars($string);
}

function __autoload($class_name)
{
    $class_name = Core::dirNameFilter($class_name);

    $model = "model/" . $class_name . ".php";
    if (file_exists($model)) {
        require_once "model/" . $class_name . ".php";
    }

    $controller = "controller/" . $class_name . ".php";
    if (file_exists($controller)) {
        require_once "controller/" . $class_name . ".php";
    }
}
