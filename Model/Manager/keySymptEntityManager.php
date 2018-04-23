<?php
class keySymptEntityManager extends EntityManager
{
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(keySymptEntity $keySympt)
    {
        $q = $this->getDb()->prepare('INSERT INTO keysympt(idK, idS) VALUES(:idK, :idS)');

        $q->bindValue(':idK', $keySympt->getIdK(), PDO::PARAM_INT);
        $q->bindValue(':idS', $keySympt->getIdS(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(keySymptEntity $keySympt)
    {
        $this->getDb()->exec('DELETE FROM keysympt WHERE idK = ' . $keySympt->getIdK() . ' and idS = ' . $keySympt->getIdS());
    }

    public function get($idK, $idS)
    {
        $idK = (int)$idK;
        $idS = (int)$idS;

        $q = $this->getDb()->query('SELECT idK, idS FROM keysympt WHERE idK = ' . $idK . ' and idS = ' . $idS);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new keySymptEntity($donnees);
    }

    public function getList()
    {
        $keySympts = [];

        $q = $this->getDb()->query('SELECT idK, idS FROM keysympt ORDER BY idK, idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
            $keySympts[] = new keySymptEntity($donnees);
        }

        return $keySympts;
    }

    public function update(keySymptEntity $keySympt)
    {

    }
}