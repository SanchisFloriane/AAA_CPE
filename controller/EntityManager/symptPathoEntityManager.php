<?php
require_once 'EntityManager.php';

class symptPathoEntityManager extends EntityManager
{ 
    public function __construct($db)
    {
        parent::__construct();
    }

    public function add(symptPathoEntity $symptPatho)
    {
        $sql = "INSERT INTO symptpatho(`idS`, `idP`, `aggr`) VALUES(?, ?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($symptPatho->getIdS(), $symptPatho->getIdP(), $symptPatho->getAggr()));
    }

    public function delete(symptPathoEntity $symptPatho)
    {
        $sql = "DELETE FROM symptpatho WHERE idP = ? and idS";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($symptPatho->getIdP(), $symptPatho->getIdS()));
    }

    public function get($idP, $idS)
    {
        $idP = (int) $idP;
        $idS = (int) $idS;

        $q = $this->getDb()->query('SELECT idP, idS, aggr FROM patho WHERE idP = '.$idP.' and idS = '. $idS);
        while ($donnees = $q->fetch())
        {
            return new symptPathoEntity($donnees['idP'], $donnees['idS'], $donnees['aggr']);
        }
    }

    public function getList()
    {
        $symptPathos = [];

        $q = $this->getDb()->query('SELECT idP, idS, aggr FROM symptpatho ORDER BY idP, idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $symptPathos[] = new symptPathoEntity($donnees['idP'], $donnees['idS'], $donnees['aggr']);
        }

        return $symptPathos;
    }

    public function update(symptPathoEntity $symptPatho)
    {
        $sql = "UPDATE symptpatho SET `aggr`=? WHERE `idP`= ? and `idS` = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute([$symptPatho->getAggr(), $symptPatho->getIdP(), $symptPatho->getIdS()]);
    }
}