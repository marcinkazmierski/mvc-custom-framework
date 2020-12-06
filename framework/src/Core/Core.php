<?php
declare(strict_types=1);

namespace Framework\Core;

use Framework\Core\DependencyInjection\Container;
use Framework\Core\DependencyInjection\ContainerInterface;
use Framework\Exception\ExceptionController;
use Framework\Service\Profiler\ProfilerInterface;

class Core
{
    /** @var ContainerInterface */
    protected $container;

    /** @var string */
    protected $environment = 'prod';

    /**
     * Core constructor.
     * @param ContainerInterface $container
     * @throws \Exception
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->environment = Config::getOption('environment');
        if (empty($this->environment)) {
            $this->environment = 'prod';
        }
    }

    public function init()
    {
        ini_set("error_log", "logs/errors.log");
        ini_set("log_errors", "1");

        switch ($this->environment) {
            case 'dev':
                ini_set('display_errors', "1");
                /** @var ProfilerInterface $profiler */
                $profiler = $this->container->get(ProfilerInterface::class);
                $profiler->start('Core:init');
                break;
            case 'test':
                ini_set('display_errors', "1");
                break;
            case 'prod':
                ini_set('display_errors', "0");
                break;
        }

        $this->startDispatcher();

        switch ($this->environment) {
            case 'dev':
                /** @var ProfilerInterface $profiler */
                $profiler = $this->container->get(ProfilerInterface::class);
                $profiler->end('Core:init');

                $render = true;
                $headers = headers_list();
                foreach ($headers as $header) {
                    if (stripos($header, "Content-type: application/json") !== false) {
                        $render = false;
                    }
                }
                if ($render) {
                    print $profiler->render();
                }
                break;
            case 'test':
                //todo test
                break;
            case 'prod':
                // todo: prod
                break;
        }
    }

    protected function startDispatcher()
    {
        $controller = '';
        $action = '';
        $param = false;

        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }
        if (isset($_GET['controller'])) {
            $controller = $_GET['controller'];
        }
        if (isset($_GET['param'])) {
            $param = $_GET['param'];
        }

        try {
            $this->useController($controller, $action, $param);
        } catch (\Exception $e) {
            $exception = new ExceptionController();
            print $exception->render($e);
            error_log(t('Fatal Error: ' . $e->getMessage()));
        }
    }

    public static function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }

    public static function dirNameFilter($name)
    {
        $name = str_replace('.', '', (string)$name);
        $name = str_replace('/', '', $name);
        return $name;
    }

    /**
     * @param string $controller
     * @param string $action
     * @param bool $param
     * @throws \Exception
     */
    public function useController(string $controller = '', string $action = '', $param = false)
    {
        if (!$controller) {
            $controller = 'index';
        }
        if (!$action) {
            $action = 'index';
        }

        $controller = strtolower($controller);
        $action = strtolower($action);
        $controller = ucfirst($controller);
        $controller = $controller . "Controller";
        $function = $action . "Action";

        $controller = 'App\\Controller\\' . $controller;

        if (class_exists($controller)) {

            $container = new Container();
            /** @var Controller $c */
            $c = $container->get($controller);
            $c->setContainer($container);
            print call_user_func_array(array($c, $function), array($param));
        } else {
            throw new \Exception(t('Controller class not found.'));
        }
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    private static function load(string $view, array $data = [])
    {
        extract(array("content" => $data));
        ob_start();
        require(APP_SRC_PATH . "/View/templates/$view.php");
        $content = ob_get_clean();
        return (string)$content;
    }

    /**
     * @param string $view
     * @param array $data
     * @param bool $returnOnlyContent
     * @return string
     */
    public static function loadView(string $view, array $data = [], bool $returnOnlyContent = false)
    {
        if ($returnOnlyContent) {
            return self::load($view, $data);
        }
        extract(array("contentAll" => self::load($view, $data)));
        ob_start();
        require(APP_SRC_PATH . "/View/layout/template.php");
        $content = ob_get_clean();
        return (string)$content;
    }
}
