<?php
class pathoEntityManager extends EntityManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(pathoEntity $patho)
    {
        $sql = "INSERT INTO patho(`mer`, `type`, `desc`) VALUES(?, ?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($patho->getMer(), $patho->getType(), $patho->getDesc()));
    }

    public function delete(pathoEntity $patho)
    {
        $sql = "DELETE FROM patho WHERE idP = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($patho->getIdP()));
    }

    public function get($idP)
    {
        $idP = (int) $idP;

        $q = $this->getDb()->query('SELECT idP, mer, type, "desc" FROM patho WHERE idP = '.$idP);
        while ($donnees = $q->fetch())
        {
            return new pathoEntity($donnees['idP'], $donnees['mer'], $donnees['type'],$donnees['desc']);
        }
    }

    public function getList()
    {
        $pathos = [];

        $q = $this->getDb()->query('SELECT idP, mer, type, "desc" FROM patho ORDER BY idP');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $pathos[] = new pathoEntity($donnees['idP'], $donnees['mer'], $donnees['type'],$donnees['desc']);
        }

        return $pathos;
    }

    public function update(pathoEntity $patho)
    {
        $sql = "UPDATE patho SET `mer`=?, `type` =?, `desc`=? WHERE `idP`= ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute([$patho->getMer(), $patho->getType(), $patho->getDesc(), $patho->getIdP()]);
    }
}