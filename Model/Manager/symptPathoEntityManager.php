<?php
class symptPathoEntityManager extends EntityManager
{ 
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(symptPathoEntity $symptPatho)
    {
        $q = $this->getDb()->prepare('INSERT INTO symptpatho(idS, idP, aggr) VALUES(:idS, :idP, :aggr)');

        $q->bindValue(':idS', $symptPatho->getIdS(), PDO::PARAM_INT);
        $q->bindValue(':idP', $symptPatho->getIdP(), PDO::PARAM_INT);
        $q->bindValue(':aggr', $symptPatho->getAggr(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(symptPathoEntity $symptPatho)
    {
        $this->getDb()->exec('DELETE FROM symptpatho WHERE idP = '.$symptPatho->getIdP() .' and idS = '. $symptPatho->getIdS());
    }

           public function get($idP, $idS)
    {
        $idP = (int) $idP;
        $idS = (int) $idS;

        $q = $this->getDb()->query('SELECT idP, idS, aggr FROM symptpatho WHERE idP = '.$idP.' and idS = '. $idS);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new symptPathoEntity($donnees);
    }

    public function getList()
    {
        $symptPathos = [];

        $q = $this->getDb()->query('SELECT idP, idS, aggr FROM symptpatho ORDER BY idP, idS');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $symptPathos[] = new symptPathoEntity($donnees);
        }

        return $symptPathos;
    }

    public function update(symptPathoEntity $symptPatho)
    {
        $q = $this->getDb()->prepare('UPDATE symptpatho SET aggr = :aggr WHERE idP = :idP and idS = :idS');

        $q->bindValue(':idP', $symptPatho->getIdP(), PDO::PARAM_INT);
        $q->bindValue(':idS', $symptPatho->getIdS(), PDO::PARAM_INT);
        $q->bindValue(':aggr', $symptPatho->getAggr(), PDO::PARAM_INT);

        $q->execute();
    }
}