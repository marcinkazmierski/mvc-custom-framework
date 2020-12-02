<?php
declare(strict_types=1);

namespace Framework\Security;

use Framework\Exception\RuntimeException;

interface PasswordManagerInterface
{
    /**
     * @param string $plainPassword
     * @return string
     * @throws RuntimeException
     */
    public function generatePasswordHash(string $plainPassword): string;

    /**
     * @param string $plainPassword
     * @param string $hashPassword
     * @return bool
     */
    public function isPasswordValid(string $plainPassword, string $hashPassword): bool;
}