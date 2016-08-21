<?php
namespace app\core\interfaces;

interface IResponse
{
    public function __construct($data, $status = 200);
}