<?php
class keyWordsEntityManager extends EntityManager
{
    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function add(keyWordsEntity $keyWords)
    {
        $q = $this->getDb()->prepare('INSERT INTO keywords(idK, name) VALUES(:idK, :name)');

        $q->bindValue(':idK', $keyWords->getIdK(), PDO::PARAM_INT);
        $q->bindValue(':name', $keyWords->getName());

        $q->execute();
    }

    public function delete(keyWordsEntity $keyWords)
    {
        $this->getDb()->exec('DELETE FROM keywords WHERE idK = '. $keyWords->getIdK());
    }

    public function get($idK)
    {
        $idK = (int) $idK;

        $q = $this->getDb()->query('SELECT idK, name FROM keywords WHERE idK = '.$idK);
        $donnees = $q->fetch(PDO::FETCH_ASSOC);

        return new keyWordsEntity($donnees);
    }

    public function getList()
    {
        $keyWordss = [];

        $q = $this->getDb()->query('SELECT idK, name FROM keywords ORDER BY name');

        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $keyWordss[] = new keyWordsEntity($donnees);
        }

        return $keyWordss;
    }

    public function update(keyWordsEntity $keyWords)
    {
        $q = $this->getDb()->prepare('UPDATE keywords SET name = :name  WHERE idK = :idK');

        $q->bindValue(':idK', $keyWords->getIdK(), PDO::PARAM_INT);
        $q->bindValue(':name', $keyWords->getName());

        $q->execute();
    }
}