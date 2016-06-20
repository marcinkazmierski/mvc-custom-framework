<?php

Class Core
{
    private function __construct()
    {

    }

    public static function init()
    {
        ini_set("log_errors", 1);
        ini_set('display_errors', 1); // debug
        ini_set("error_log", "logs/errors.log");
        self::startDispatcher();
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
        } catch (Exception $e) {
            print t('Fatal Error: ' . $e->getMessage());
            error_log(t('Fatal Error: ' . $e->getMessage()));
            die();
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
        $name = str_replace('\\', '', $name);
        return $name;
    }

    public static function useController($controller = false, $action = false, $param = false)
    {
        if (!$controller) {
            $controller = 'index'; //TODO
        }
        if (!$action) {
            $action = 'index';
        }

        $controller = strtolower($controller);
        $action = strtolower($action);
        $controller = ucfirst($controller);
        $controller = $controller . "Controller";
        $function = $action . "Action";

        if (class_exists($controller)) {
            $c = new $controller();
            $c->$function($param);
        } else {
            throw new Exception(t('Controller class not found.'));
        }
    }

    private static function load($view, $data = null)
    {
        global $baseDir;
        extract(array("content" => $data));
        ob_start();
        require($baseDir . "/view/$view.php");
        $content = ob_get_clean();
        return $content;
    }

    public static function loadView($view, $data = null)
    {
        global $baseDir;
        extract(array("contentAll" => self::load($view, $data)));
        ob_start();
        require($baseDir . "/view/layout/template.php");
        $content = ob_get_clean();
        return $content;
    }
}
