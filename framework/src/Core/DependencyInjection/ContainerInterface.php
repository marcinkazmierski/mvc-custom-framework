<?php
declare(strict_types=1);

namespace Framework\Core\DependencyInjection;

interface ContainerInterface
{
    /**
     * @param string $id
     * @param object $service
     */
    public function set(string $id, object $service): void;

    /**
     * @param string $id
     * @return object|null
     */
    public function get(string $id): ?object;
}
