<?php
require '../Model/Manager/EntityManager.php';

class meridienEntityManager extends EntityManager
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(meridienEntity $meridien)
    {
        $sql = "INSERT INTO meridien(`code`, `nom`, `element`, `yin`) VALUES(?, ?, ?, ?)";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($meridien->getCode(), $meridien->getNom(), $meridien->getElement(),$meridien->getYin()));
    }

    public function delete(meridienEntity $meridien)
    {
        $sql = "DELETE FROM meridien WHERE code = ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute(array($meridien->getCode()));
    }

    public function get($code)
    {
        $q = $this->getDb()->query('SELECT code, nom, element, yin FROM meridien WHERE code = '. $code);
        while ($donnees = $q->fetch())
        {
            return new meridienEntity($donnees['code'], $donnees['nom'], $donnees['element'],$donnees['yin']);
        }
    }

    public function getList()
    {
        $meridiens = [];

        $q = $this->getDb()->query('SELECT code, nom, element, yin FROM meridien ORDER BY nom');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $meridiens[] = new meridienEntity($donnees['code'], $donnees['nom'], $donnees['element'],$donnees['yin']);
        }

        return $meridiens;
    }

    public function update(meridienEntity $meridien)
    {
        $sql = "UPDATE patho SET `nom`=?, `element` =?, `yin`=? WHERE `code`= ?";
        $stmt= $this->getDb()->prepare($sql);
        $stmt->execute([$meridien->getNom(), $meridien->getElement(), $meridien->getYin(), $meridien->getCode()]);
    }
}