<?php

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
        echo t("Strona nie istnieje!");
        die();
    }

    public function renderView($viewName, $variables = null)
    {
        return Core::loadView($viewName, $variables);
    }


}