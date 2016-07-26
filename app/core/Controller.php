<?php
namespace app\core;

abstract class Controller implements IController
{
    protected static $controller = null;
    protected $cache = null;

    protected function __clone()
    {

    }

    protected function __construct()
    {
        $this->cache = new Cache();
    }

    public function __call($name, $arguments) // if page not found
    {
        echo t("Page not found");
        die();
    }

    public function renderView($viewName, $variables = null, $content_type = null)
    {
        $body = Core::loadView($viewName, $variables);
        return new Response($body, 200, $content_type);
    }
}