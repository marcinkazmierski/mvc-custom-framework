<?php
declare(strict_types=1);

namespace Framework\Service\Profiler;

interface IProfiler
{
    public function start($name);
    public function end($name);
    public function getAllStats();
}