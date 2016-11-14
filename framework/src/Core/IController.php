<?php
declare(strict_types=1);

namespace Core;

interface IController
{
    public function renderView($viewName, $variables);

    public function isAuth();

    public function setAuth($login);

    public function destroyAuth();
}