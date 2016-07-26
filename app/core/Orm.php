<?php
namespace app\core;

abstract class Orm implements IOrm
{
    protected $databaseName;

    public function __construct($databaseName)
    {
        $this->databaseName = $databaseName;
    }

    public function getAll()
    {
        $sth = Database::getInstance()->query('SELECT * FROM ' . $this->databaseName);
        $results = $sth->fetchAll();
        $sth->closeCursor();
        return $results;
    }

    public function getById($id)
    {
        $sth = Database::getInstance()->prepare('SELECT * FROM ' . $this->databaseName . ' WHERE id=:id;');
        $sth->execute(array(':id' => (int)$id));
        $results = $sth->fetch();
        $sth->closeCursor();
        return $results;
    }

    public function execute($sql, array $params = array())
    {
        // TODO: Implement execute() method.
    }
}