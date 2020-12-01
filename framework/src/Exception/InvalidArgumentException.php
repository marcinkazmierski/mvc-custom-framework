<?php
declare(strict_types = 1);

namespace Framework\Exception;


class InvalidArgumentException extends \Exception
{
    public function __construct($message = 'Invalid argument!')
    {
        parent::__construct($message, 500);
    }
}