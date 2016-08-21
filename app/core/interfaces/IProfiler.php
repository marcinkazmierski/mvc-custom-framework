<?php
namespace app\core\interfaces;

interface IProfiler
{
    public function start($name);
    public function end($name);
    public function getAllStats();
}