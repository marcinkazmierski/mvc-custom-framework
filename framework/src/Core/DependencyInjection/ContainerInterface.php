<?php
declare(strict_types=1);

namespace Framework\Core\DependencyInjection;

use Framework\Exception\RuntimeException;

interface ContainerInterface
{
    /**
     * @param string $id
     * @param object $service
     */
    public function set(string $id, object $service): void;

    /**
     * @param string $className
     * @return object
     * @throws RuntimeException
     */
    public function get(string $className): object;
}
