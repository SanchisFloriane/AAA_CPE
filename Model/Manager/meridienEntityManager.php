<?php
class meridienEntityManager extends EntityManager
{
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(meridienEntity $meridien)
    {
        $q = $this->getDb()->prepare('INSERT INTO meridien(code, nom, element, yin) VALUES(:code, :nom, :element, :yin)');

        $q->bindValue(':code', $meridien->getCode());
        $q->bindValue(':nom', $meridien->getNom());
        $q->bindValue(':element', $meridien->getElement());
        $q->bindValue(':yin', $meridien->getYin(), PDO::PARAM_INT);

        $q->execute();
    }

    public function delete(meridienEntity $meridien)
    {
        $this->getDb()->exec('DELETE FROM meridien WHERE code = '. $meridien->getCode());
    }

    public function get($code)
    {
        $q = $this->getDb()->query('SELECT code, nom, element, yin FROM meridien WHERE code = '. $code);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new meridienEntity($donnees);
    }

    public function getList()
    {
        $meridiens = [];

        $q = $this->getDb()->query('SELECT code, nom, element, yin FROM meridien ORDER BY nom');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $meridiens[] = new meridienEntity($donnees);
        }

        return $meridiens;
    }

    public function update(meridienEntity $meridien)
    {
        $q = $this->getDb()->prepare('UPDATE meridien SET nom= :nom , element= :element , yin = :yin WHERE code = :code');

        $q->bindValue(':idS', $meridien->getCode());
        $q->bindValue(':desc', $meridien->getNom());
        $q->bindValue(':desc', $meridien->getElement());
        $q->bindValue(':idS', $meridien->getYin(), PDO::PARAM_INT);

        $q->execute();
    }
}