<?php
declare(strict_types = 1);

namespace Framework\Database\Hydrator;

use Framework\Database\Entity\Entity;

class Hydrator implements IHydrator
{

    public function extract(Entity $object):array
    {
        return []; // TODO: Implement extract() method.
    }

    public function hydrate(array $data, Entity $object):void
    {
        return; // TODO: Implement hydrate() method.
    }
}