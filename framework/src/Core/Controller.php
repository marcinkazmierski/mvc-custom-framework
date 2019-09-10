<?php
declare(strict_types=1);

namespace Core;

use Exception\NotFoundException;
use Response\Response;
use Service\Auth\Auth;
use Service\Cache\Cache;

/**
 * Class Controller
 * @package Core
 */
abstract class Controller implements IController
{
    protected static $controller = null;
    protected $cache = null;
    protected $auth = null;

    public function __construct()
    {
        $this->cache = new Cache(); // TODO: DI
        $this->auth = Auth::getInstance();
    }

    /**
     * @param $name
     * @param $arguments
     * @throws NotFoundException
     */
    public function __call($name, $arguments) // if page not found
    {
        throw new NotFoundException();
    }

    /**
     * @param $viewName
     * @param null $variables
     * @param null $content_type
     * @param bool $returnOnlyContent
     * @param int $status
     * @return Response
     */
    public function renderView($viewName, $variables = null, $content_type = null, $returnOnlyContent = false, $status = 200)
    {
        $body = Core::loadView($viewName, $variables, $returnOnlyContent);
        return new Response($body, $status, $content_type);
    }

    /**
     * @return bool
     */
    public function isAuth()
    {
        return $this->auth->isAuth();
    }

    /**
     * @param $login
     * @return bool
     */
    public function setAuth($login)
    {
        return $this->auth->setAuth($login);
    }

    public function destroyAuth()
    {
        $this->auth->destroyAuth();
    }
}