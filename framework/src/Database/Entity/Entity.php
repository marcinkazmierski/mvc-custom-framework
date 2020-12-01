<?php
declare(strict_types = 1);

namespace Framework\Database\Entity;

abstract class Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function setId(int $id):Entity
    {
        $this->id = $id;
        return $this;
    }
}