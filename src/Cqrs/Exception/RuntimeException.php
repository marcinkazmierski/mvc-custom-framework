<?php
declare(strict_types = 1);

namespace Cqrs\Exception;

/**
 * Class RuntimeException
 * @package Cqrs\Exception
 */
class RuntimeException extends \Exception
{
    public function __construct($message = 'Runtime exception!')
    {
        parent::__construct($message, 500);
    }
}