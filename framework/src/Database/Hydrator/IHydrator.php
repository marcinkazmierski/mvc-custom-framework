<?php
declare(strict_types=1);

namespace Framework\Database\Hydrator;


use Framework\Database\Entity\Entity;

interface IHydrator
{
    /**
     * Extract values from an object
     *
     * @param Entity $object
     * @return array
     */
    public function extract(Entity $object): array;

    /**
     * Hydrate $object with the provided $data.
     *
     * @param array $data
     * @param Entity $object
     * @return void
     */
    public function hydrate(array $data, Entity $object): void;
}