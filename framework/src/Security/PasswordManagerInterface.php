<?php
declare(strict_types=1);

namespace Framework\Security;

interface PasswordManagerInterface
{
    public function generatePasswordHash(string $plainPassword): string;

    public function isPasswordValid(): bool;
}