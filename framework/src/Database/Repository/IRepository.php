<?php
declare(strict_types = 1);

namespace Framework\Database\Repository;


use Framework\Database\Entity\Entity;

interface IRepository
{
    public function getById(int $id):Entity;


    public function getAll():array;


    public function persist(Entity $entity):IRepository;
}