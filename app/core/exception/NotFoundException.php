<?php

namespace app\core\exception;


class NotFoundException extends \Exception
{
    public function __construct($message = '404 not found!')
    {
        parent::__construct($message, 404);
    }
}