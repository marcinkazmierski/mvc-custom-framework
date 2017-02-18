<?php
declare(strict_types = 1);

namespace Cqrs\Exception;

/**
 * Class InvalidValueObjectException
 * @package Cqrs\Exception
 */
class InvalidValueObjectException extends \Exception
{
    public function __construct($message = 'Invalid value!')
    {
        parent::__construct($message, 301);
    }
}