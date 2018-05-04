<?php
require '../Model/Manager/EntityManager.php';

class keySymptEntityManager extends EntityManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(keySymptEntity $keySympt)
    {
        $sql = "INSERT INTO keysympt(`idK`, `idS`) VALUES(?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($keySympt->getIdK(), $keySympt->getIdS()));
    }

    public function delete(keySymptEntity $keySympt)
    {
        $sql = "DELETE FROM keysympt WHERE idP = ? and idS = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($keySympt->getIdP(),$keySympt->getIdS()));
    }

    public function get($idK, $idS)
    {
        $idK = (int)$idK;
        $idS = (int)$idS;

        $q = $this->getDb()->query('SELECT idK, idS FROM keysympt WHERE idK = '. $idK .' and idS = '. $idS);
        while ($donnees = $q->fetch())
        {
            return new keySymptEntity($donnees['idK'], $donnees['idS']);
        }
    }

    public function getList()
    {
        $keySympts = [];

        $q = $this->getDb()->query('SELECT idK, idS FROM keysympt ORDER BY idK, idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $keySympts[] = keySymptEntity($donnees['idK'], $donnees['idS']);
        }

        return $keySympts;
    }
}