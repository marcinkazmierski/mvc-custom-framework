<?php
declare(strict_types=1);

namespace Framework\Core;

use Framework\Core\DependencyInjection\ContainerInterface;
use Framework\Exception\NotFoundException;
use Framework\Exception\RuntimeException;
use Framework\Response\Response;
use Framework\Service\Auth\Auth;
use Framework\Service\Cache\Cache;

/**
 * Class Controller
 * @package Core
 */
abstract class Controller implements IController
{
    /** @var ContainerInterface */
    private $container;

    /** @var string */
    private $environment;

    /**
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer(): ContainerInterface
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }

    /**
     * @param string $environment
     */
    public function setEnvironment(string $environment): void
    {
        $this->environment = $environment;
    }

    /**
     * @return Cache
     * @throws RuntimeException
     */
    public function getCache(): Cache
    {
        /** @var Cache $instance */
        $instance = $this->container->get(Cache::class);
        return $instance;
    }

    /**
     * @return Auth
     * @throws RuntimeException
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
     * @throws RuntimeException
     */
    public function isAuth()
    {
        return $this->getAuth()->isAuth();
    }

    /**
     * @param string $login
     * @return bool
     * @throws RuntimeException
     */
    public function setAuth(string $login)
    {
        return $this->getAuth()->setAuth($login);
    }

    /**
     * @throws RuntimeException
     */
    public function destroyAuth()
    {
        $this->getAuth()->destroyAuth();
    }
}
