<?php
require_once 'EntityManager.php';

class pathologieEntityManager extends EntityManager
{
    public function __construct()
    {
        parent::__construct();
    }



    public function get($idP)
    {
        $idP = (int) $idP;

        $q = $this->getDb()->query('SELECT * FROM pathologies WHERE idP = '.$idP);
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $pathologie = new Pathologie($donnees);
            return $pathologie;
            //return new pathoEntity($donnees['idP'], $donnees['mer'], $donnees['type'],$donnees['desc']);
        }
    }

    public function getList()
    {
        $pathos = [];

        $q = $this->getDb()->query('SELECT * FROM pathologies ORDER BY idP');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $pathos[] = new Pathologie($donnees);
        }

        return $pathos;
    }


}