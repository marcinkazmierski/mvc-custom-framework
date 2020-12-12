<?php
declare(strict_types=1);

namespace Framework\Service\Profiler;

interface ProfilerInterface
{
    /**
     * @param string $key
     */
    public function start(string $key): void;

    /**
     * @param string $key
     */
    public function end(string $key): void;

    /**
     * @return string
     */
    function render(): string;
}