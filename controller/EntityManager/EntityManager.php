<?php
foreach (glob('Model/*.php') as $file) {
    if(is_file($file))
        require_once($file);
}
class EntityManager
{
    private $_db; // Instance de PDO

    public function __construct()
    {
        try
        {
            $this->_db = $GLOBALS['PDO'];
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