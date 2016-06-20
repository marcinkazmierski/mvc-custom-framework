<?php
namespace app\core;

interface IController
{
    public function renderView($viewName, $variables);
}