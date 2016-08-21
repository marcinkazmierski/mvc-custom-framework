<?php
namespace app\core\interfaces;

interface IOrm
{
    public function getAll($limit);

    public function getById($id);

    public function execute($sql, array $params);
}