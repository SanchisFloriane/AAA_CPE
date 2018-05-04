<?php

class EntityManager
{
    private $_db; // Instance de PDO

    public function __construct()
    {
        try
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=aaa;charset=utf8', 'root', '');
            echo 'BDD Connectée';
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getDb()
    {
        return $this->_db;
    }
}