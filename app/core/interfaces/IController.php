<?php
namespace app\core\interfaces;

interface IController
{
    public function renderView($viewName, $variables);

    public function isAuth();

    public function setAuth($login);

    public function destroyAuth();
}