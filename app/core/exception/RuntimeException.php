<?php

namespace app\core\exception;

class RuntimeException extends \Exception
{
    public function __construct($message = 'Runtime exception!')
    {
        parent::__construct($message, 500);
    }
}