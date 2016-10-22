<?php
namespace app\core;

use app\core\exception\NotFoundException;
use app\core\interfaces\IController;

abstract class Controller implements IController
{
    protected static $controller = null;
    protected $cache = null;
    protected $auth = null;

    public function __construct()
    {
        $this->cache = new Cache();
        $this->auth = Auth::getInstance();
    }

    public function __call($name, $arguments) // if page not found
    {
        throw new NotFoundException();
    }

    public function renderView($viewName, $variables = null, $content_type = null, $returnOnlyContent = false, $status = 200)
    {
        $body = Core::loadView($viewName, $variables, $returnOnlyContent);
        return new Response($body, $status, $content_type);
    }

    public function isAuth()
    {
        return $this->auth->isAuth();
    }


    public function setAuth($login)
    {
        return $this->auth->setAuth($login);
    }

    public function destroyAuth()
    {
        $this->auth->destroyAuth();
    }
}