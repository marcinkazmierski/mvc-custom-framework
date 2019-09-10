<?php
declare(strict_types=1);

namespace Core;

use Core\DependencyInjection\Container;
use Exception\ExceptionController;
use Service\Profiler\Profiler;

class Core
{
    private function __construct()
    {
    }

    public static function init()
    {
        Profiler::getInstance()->start('Core:init');
        ini_set("log_errors", (string)(int)Profiler::getInstance()->isEnabled()); //TODO: value object
        ini_set('display_errors', (string)(int)Profiler::getInstance()->isEnabled()); //TODO: value object
        ini_set("error_log", "logs/errors.log");
        self::startDispatcher();
        Profiler::getInstance()->end('Core:init');

        print Profiler::getInstance()->getAllStats();
    }

    private static function startDispatcher()
    {
        $controller = false;
        $action = false;
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
            Core::useController($controller, $action, $param);
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

    public static function useController($controller = false, $action = false, $param = false)
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

        $controller = 'Controller' . '\\' . $controller;

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
     * @param null $data @todo: as array
     * @return string
     */
    private static function load(string $view, $data = null)
    {
        extract(array("content" => $data));
        ob_start();
        require(APP_SRC_PATH . "/View/templates/$view.php");
        $content = ob_get_clean();
        return (string)$content;
    }

    /**
     * @param string $view
     * @param null $data @todo: as array
     * @param bool $returnOnlyContent
     * @return string
     */
    public static function loadView(string $view, $data = null, bool $returnOnlyContent = false)
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
