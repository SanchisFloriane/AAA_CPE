<?php
class keyWordsEntity
{
    private $_idK;
    private $_name;

    public function __construct($idK, $name)
    {
        $this->setIdK($idK);
        $this->setName($name);
    }

    public function getIdK()
    {
        return $this->_idK;
    }

    public function setIdK($idK)
    {
        $idK = (int) $idK;
        $this->_idK = $idK;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function setName($name)
    {
        if (is_string($name)) {
            $this->_name = $name;
        }
    }
}