<?php
declare(strict_types = 1);

namespace Cqrs\Query\Query;

use Cqrs\Query\ViewObject\UserView;

interface UserQuery
{
    public function getUserById(int $userId) : UserView;

    public function getAllUsers() : array;
}