<?php
declare(strict_types = 1);

namespace Cqrs\Query\Query;

use Cqrs\Query\ViewObject\UserView;

interface UserQuery
{
    public function getById(int $userId) : UserView;

    public function getAll() : array;
}