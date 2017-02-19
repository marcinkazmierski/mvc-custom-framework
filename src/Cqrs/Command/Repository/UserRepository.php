<?php
declare(strict_types = 1);

namespace Cqrs\Command\Repository;

use Cqrs\Domain\User;

interface UserRepository
{
    public function add(User $user);
}