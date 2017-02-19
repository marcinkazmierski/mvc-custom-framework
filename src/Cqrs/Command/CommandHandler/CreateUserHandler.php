<?php
declare(strict_types = 1);

namespace Cqrs\Command\CommandHandler;

use Cqrs\Command\Command\Command;
use Cqrs\Command\Command\CreateUserCommand;
use Cqrs\Command\Repository\UserRepository;
use Cqrs\Domain\User;

class CreateUserHandler implements CommandHandler
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(Command $command)
    {
        /** @var CreateUserCommand $command */
        $user = new User($command->getEmail(), $command->getUsername());

        $this->userRepository->add($user);
    }
}