<?php
namespace app\core;

abstract class Controller implements IController
{
    protected static $controller = null;

    protected function __clone()
    {

    }

    protected function __construct()
    {

    }

    public function __call($name, $arguments) // if page not found
    {
        echo t("Page not found");
        die();
    }

    public function renderView($viewName, $variables = null)
    {
        return Core::loadView($viewName, $variables);
    }
}