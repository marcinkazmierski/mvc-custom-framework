<?php
declare(strict_types=1);

namespace Framework\Database\Orm;

use Framework\Core\Config;
use Framework\Database\Database;

abstract class Orm implements IOrm
{
    private $tableName;
    protected $databaseInstance;
    protected $environment;

    /**
     * Orm constructor.
     * @param $tableName
     * @throws \Exception
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
        $this->databaseInstance = Database::getInstance();
        $this->environment = Config::getOption('environment');
        if (empty($this->environment)) {
            $this->environment = 'prod';
        }
    }

    public function getAll($limit = 20)
    {
        return $this->execute('SELECT * FROM ' . $this->tableName . ' LIMIT ' . $limit);
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