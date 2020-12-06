<?php
declare(strict_types=1);

namespace Framework\Service\Auth;

class Auth
{
    const FIELD_USER_LOGIN = 'auth_user_login';
    const FIELD_IS_AUTHENTICATED = 'auth_authenticated';

    /**
     * @param string $login
     * @return bool
     */
    public function setAuth(string $login): bool
    {
        $_SESSION[self::FIELD_USER_LOGIN] = $login;
        $_SESSION[self::FIELD_IS_AUTHENTICATED] = true;
        return true;
    }

    /**
     * @return bool
     */
    public function isAuth(): bool
    {
        if (isset($_SESSION[self::FIELD_IS_AUTHENTICATED]) && $_SESSION[self::FIELD_IS_AUTHENTICATED] === true) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function destroyAuth(): bool
    {
        $_SESSION[self::FIELD_IS_AUTHENTICATED] = false;
        @session_destroy();
        return true;
    }
}