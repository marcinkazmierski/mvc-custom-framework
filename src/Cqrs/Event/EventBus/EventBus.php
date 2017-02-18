<?php
declare(strict_types = 1);

namespace Cqrs\Event\EventBus;

use Cqrs\Event\Event\Event;

interface EventBus
{
    public function registerHandler(string $commandClass, CommandHandler $handler) : void;

    public function handle(Event $command) : void;
}