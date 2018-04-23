<?php
class EntityManager
{
    private $_db; // Instance de PDO

    public function setDb(PDO $db)
    {
        $this->_db = new PDO('mysql:host=localhost;dbname=AAA', 'root', '');
    }

    public function getDb()
    {
        return $this->_db;
    }
}