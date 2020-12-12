<?php


namespace Framework\Service\Logger;


class BasicLogger implements LoggerInterface
{
    public const INFO = 200;
    public const ERROR = 400;
    public const CRITICAL = 500;

    /**
     * @param string $message
     * @param array $context
     */
    public function error(string $message, array $context = []): void
    {
        $this->log(self::ERROR, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function info(string $message, array $context = []): void
    {
        $this->log(self::INFO, $message, $context);
    }

    /**
     * @param string $message
     * @param array $context
     */
    public function critical(string $message, array $context = []): void
    {
        $this->log(self::CRITICAL, $message, $context);
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     */
    protected function log(string $level, string $message, array $context = []): void
    {
        $file = APP_ROOT . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . date('d-m-Y') . '.log';
        $content = sprintf('%s - LEVEL: %s, MESSAGE: "%s", CONTEXT: %s', date('H:i:s d-m-Y'), $level, $message, json_encode($context)) . PHP_EOL;
        file_put_contents($file, $content, FILE_APPEND);
    }
}