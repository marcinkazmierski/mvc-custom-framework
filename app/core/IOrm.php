<?php
namespace app\core;

interface IOrm
{
    public function getAll();

    public function getById($id);

    public function execute($sql, array $params = array());
}