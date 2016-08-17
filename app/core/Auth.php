<?php
namespace app\core;

class Auth
{
    private static $instance = null;

    private function __construct() // private
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Auth();
        }
        return self::$instance;
    }

    public function setAuth($login)
    {
        $_SESSION['auth_user_login'] = $login;
        $_SESSION['auth_authenticated'] = true;
        return true;
    }

    public function isAuth()
    {
        if (isset($_SESSION['auth_authenticated']) && $_SESSION['auth_authenticated'] === true) {
            return true;
        }
        return false;
    }

    public function destroyAuth()
    {
        $_SESSION['auth_authenticated'] = array();
        @session_destroy();
    }
}