<?php
declare(strict_types=1);

namespace Framework\Core;

interface IController
{
    public function renderView(string $viewName, array $variables = [], string $content_type = null, bool $returnOnlyContent = false, int $status = 200);

    public function isAuth();

    public function setAuth(string $login);

    public function destroyAuth();
}