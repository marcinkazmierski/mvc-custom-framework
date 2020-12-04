<?php
declare(strict_types=1);

namespace Framework\Core;


use Framework\Core\DependencyInjection\Container;
use Framework\Exception\NotFoundException;
use Framework\Response\Response;
use Framework\Service\Auth\Auth;
use Framework\Service\Cache\Cache;

/**
 * Class Controller
 * @package Core
 */
abstract class Controller implements IController
{
    /** @var Container */
    private $container;

    /**
     * @param Container $container
     */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }

    /**
     * @return Cache
     */
    public function getCache(): Cache
    {
        /** @var Cache $instance */
        $instance = $this->container->get(Cache::class);
        return $instance;
    }

    /**
     * @return Auth
     */
    public function getAuth(): Auth
    {
        /** @var Auth $instance */
        $instance = $this->container->get(Auth::class);
        return $instance;
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
     * @param string $viewName
     * @param array $variables
     * @param string|null $content_type
     * @param bool $returnOnlyContent
     * @param int $status
     * @return Response
     */
    public function renderView(string $viewName, array $variables = [], string $content_type = null, bool $returnOnlyContent = false, int $status = 200)
    {
        $body = Core::loadView($viewName, $variables, $returnOnlyContent);
        return new Response($body, $status, $content_type);
    }

    /**
     * @return bool
     */
    public function isAuth()
    {
        return $this->getAuth()->isAuth();
    }

    /**
     * @param $login
     * @return bool
     */
    public function setAuth($login)
    {
        return $this->getAuth()->setAuth($login);
    }

    public function destroyAuth()
    {
        $this->getAuth()->destroyAuth();
    }
}
