<?php
class pathoEntityManager extends EntityManager
{
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(pathoEntity $patho)
    {
        $q = $this->getDb()->prepare('INSERT INTO patho(mer, type, "desc") VALUES(:mer, :type, :desc)');

        $q->bindValue(':mer', $patho->getMer());
        $q->bindValue(':type', $patho->getType());
        $q->bindValue(':desc', $patho->getDesc());

        $q->execute();
    }

    public function delete(pathoEntity $patho)
    {
        $this->getDb()->exec('DELETE FROM patho WHERE idP = '.$patho->getIdP());
    }

    public function get($idP)
    {
        $idP = (int) $idP;

        $q = $this->getDb()->query('SELECT idP, mer, type, "desc" FROM patho WHERE idP = '.$idP);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new pathoEntity($donnees);
    }

    public function getList()
    {
        $pathos = [];

        $q = $this->getDb()->query('SELECT idP, mer, type, "desc" FROM patho ORDER BY idP');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $pathos[] = new pathoEntity($donnees);
        }

        return $pathos;
    }

    public function update(pathoEntity $patho)
    {
        $q = $this->getDb()->prepare('UPDATE patho SET mer = :mer, type = :type, "desc" = :desc WHERE idP = :idP');

        $q->bindValue(':idP', $patho->getIdP(), PDO::PARAM_INT);
        $q->bindValue(':mer', $patho->getMer());
        $q->bindValue(':type', $patho->getType());
        $q->bindValue(':desc', $patho->getDesc());

        $q->execute();
    }
}