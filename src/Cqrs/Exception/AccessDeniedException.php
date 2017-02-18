<?php
declare(strict_types = 1);

namespace Cqrs\Exception;

/**
 * Class AccessDeniedException
 * @package Cqrs\Exception
 */
class AccessDeniedException extends \Exception
{
    public function __construct($message = 'Access Denied!')
    {
        parent::__construct($message, 403);
    }
}