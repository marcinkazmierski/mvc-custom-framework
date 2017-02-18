<?php
declare(strict_types = 1);

namespace Cqrs\Query\Query;

use Cqrs\Query\ViewObject\CartView;

interface CartQuery
{
    public function getById(int $userId) : CartView;

    public function getAll() : array;

    public function getAllProducts():array;
}