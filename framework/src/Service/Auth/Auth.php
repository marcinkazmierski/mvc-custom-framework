<?php
declare(strict_types=1);

namespace Service\Auth;

class Auth
{
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