<?php

namespace app\core\exception;

class AccessDeniedException extends \Exception
{
    public function __construct($message = 'Access Denied!')
    {
        parent::__construct($message, 403);
    }
}