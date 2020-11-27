<?php
declare(strict_types=1);

namespace Framework\Security;


class PasswordManager implements PasswordManagerInterface
{
    public function generatePasswordHash(string $plainPassword): string
    {
        // TODO: Implement generatePasswordHash() method.
    }

    public function isPasswordValid(): bool
    {
        // TODO: Implement isPasswordValid() method.
    }

}