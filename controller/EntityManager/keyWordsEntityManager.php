<?php
require_once 'EntityManager.php';

class keyWordsEntityManager extends EntityManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(keyWordsEntity $keyWords)
    {
        $sql = "INSERT INTO keywords(`idK`, `name`) VALUES(?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($keyWords->getIdK(), $keyWords->getName()));
    }

    public function delete(keyWordsEntity $keyWords)
    {
        $sql = "DELETE FROM keywords WHERE idK = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($keyWords->getIdK()));
    }

    public function get($idK)
    {
        $idK = (int) $idK;

        $q = $this->getDb()->query('SELECT idK, name FROM keywords WHERE idP = '.$idK);
        while ($donnees = $q->fetch())
        {
            return new keyWordsEntity($donnees['idK'], $donnees['name']);
        }
    }

    public function getList()
    {
        $keyWordss = [];


        $q = $this->getDb()->query('SELECT idK, name FROM keywords ORDER BY name');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $keyWordss[] = new keyWordsEntity($donnees['idK'], $donnees['name']);
        }

        return $keyWordss;
    }

    public function update(keyWordsEntity $keyWords)
    {
        $sql = "UPDATE keywords SET `name`=? WHERE `idK`= ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute([$keyWords->getName(),$keyWords->getIdK()]);
    }
}