<?php
class symptomeEntityManager  extends EntityManager
{
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(symptomeEntity $symptome)
    {
        $q = $this->getDb()->prepare('INSERT INTO symptome(idS, "desc") VALUES(:idS, :desc)');

        $q->bindValue(':idS', $symptome->getIdS(), PDO::PARAM_INT);
        $q->bindValue(':desc', $symptome->getDesc());

        $q->execute();
    }

    public function delete(symptomeEntity $symptome)
    {
        $this->getDb()->exec('DELETE FROM symptome WHERE idS = '. $symptome->getIdS());
    }

    public function get($idS)
    {
        $idS = (int) $idS;

        $q = $this->getDb()->query('SELECT idS, "desc" FROM symptome WHERE idS = '. $idS);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new symptomeEntity($donnees);
    }

    public function getList()
    {
        $symptomes = [];

        $q = $this->getDb()->query('SELECT idS, "desc" FROM symptome ORDER BY idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $symptomes[] = new symptomeEntity($donnees);
        }

        return $symptomes;
    }

    public function update(symptomeEntity $symptome)
    {
        $q = $this->getDb()->prepare('UPDATE symptome SET "desc" = :aggr WHERE idS = :idS');

        $q->bindValue(':idS', $symptome->getIdS(), PDO::PARAM_INT);
        $q->bindValue(':desc', $symptome->getDesc());

        $q->execute();
    }
}