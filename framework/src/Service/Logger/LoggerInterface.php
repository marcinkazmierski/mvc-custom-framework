<?php


namespace Framework\Service\Logger;


interface LoggerInterface
{
    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void;

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []): void;

    /**
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = []): void;
}