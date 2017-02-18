<?php
declare(strict_types = 1);

namespace Cqrs\Command\CommandBus;

use Cqrs\Command\Command\Command;
use Cqrs\Command\CommandHandler\CommandHandler;

interface CommandBus
{
    public function registerHandler(string $commandClass, CommandHandler $handler) : void;

    public function handle(Command $command) : void;
}