<?php
declare(strict_types = 1);

namespace Cqrs\Command\CommandHandler;

use Cqrs\Command\Command\Command;

interface CommandHandler
{
    public function handle(Command $command);
}