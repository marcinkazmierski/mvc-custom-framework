<?php
namespace app\core;

interface IController
{
    public function renderView($viewName, $variables);

    public function isAuth();

    public function setAuth($login);

    public function destroyAuth();
}