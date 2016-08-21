<?php
namespace app\core;

use app\core\interfaces\IOrm;

abstract class Orm implements IOrm
{
    private $tableName;
    protected $databaseInstance;

    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->databaseInstance = Database::getInstance();
    }

    public function getAll($limit = 20)
    {
        $results = $this->execute('SELECT * FROM ' . $this->tableName . ' LIMIT ' . $limit);
        return $results;
    }

    public function getById($id)
    {
        $params = array(':id' => (int)$id);

        $results = $this->execute('SELECT * FROM ' . $this->tableName . ' WHERE id=:id;', $params);
        if (!empty($results) && is_array($results)) {
            return array_pop($results);
        }
        return null;
    }

    public function execute($sql, array $params = array())
    {
        $sth = $this->databaseInstance->prepare($sql);
        $sth->execute($params);
        $results = null;
        if ($sth->columnCount()) {
            $results = $sth->fetchAll(\PDO::FETCH_OBJ);
        }
        $sth->closeCursor();
        return $results;
    }

    protected function lastInsertId()
    {
        return (int)$this->databaseInstance->lastInsertId();
    }
}