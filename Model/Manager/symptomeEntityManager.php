<?php
require '../Model/Manager/EntityManager.php';

class symptomeEntityManager  extends EntityManager
{
    public function __construct($db)
    {
        parent::__construct();
    }

    public function add(symptomeEntity $symptome)
    {
        $sql = "INSERT INTO symptome(`idS`, `desc`) VALUES(?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array( $symptome->getIdS(), $symptome->getDesc()));
    }

    public function delete(symptomeEntity $symptome)
    {
        $sql = "DELETE FROM symptome WHERE idP = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($symptome->getIdS()));
    }

    public function get($idS)
    {
        $idS = (int) $idS;

        $q = $this->getDb()->query('SELECT idS, "desc" FROM symptome WHERE idS = '.idS);
        while ($donnees = $q->fetch())
        {
            return new symptomeEntity($donnees['idS'], $donnees['desc']);
        }
    }

    public function getList()
    {
        $symptomes = [];

        $q = $this->getDb()->query('SELECT idS, "desc" FROM symptome ORDER BY idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $symptomes[] =  new pathoEntity($donnees['idS'], $donnees['desc']);
        }

        return $symptomes;
    }

    public function update(symptomeEntity $symptome)
    {
        $sql = "UPDATE symptome SET `desc`=? WHERE `idS`= ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute([$symptome->getDesc(), $symptome->getIdS()]);
    }
}