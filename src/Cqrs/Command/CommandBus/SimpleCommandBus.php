<?php
declare(strict_types = 1);

namespace Cqrs\Command\CommandBus;

use Cqrs\Command\Command\Command;
use Cqrs\Command\CommandHandler\CommandHandler;

class SimpleCommandBus implements CommandBus
{
    /** @var CommandHandler[] */
    private $handlers = [];

    public function registerHandler(string $commandClass, CommandHandler $handler)
    {
        $this->handlers[$commandClass] = $handler;
    }

    public function handle(Command $command)
    {
        if (isset($this->handlers[get_class($command)])) {
            $this->handlers[get_class($command)]->handle($command);
        }
    }
}