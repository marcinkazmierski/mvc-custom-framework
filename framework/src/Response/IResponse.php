<?php
declare(strict_types=1);

namespace Response;

interface IResponse
{
    public function __construct($data, $status = 200);
}