<?php
namespace app\core;

interface IResponse
{
    public function __construct($data, $status = 200);
}