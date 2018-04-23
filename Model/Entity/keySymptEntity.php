<?php
class keySymptEntity
{
    private $_idK;
    private $_idS;

    public function __construct($idK, $idS)
    {
        $this->setIdK($idK);
        $this->setIdS($idS);
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

    public function getIdS()
    {
        return $this->_idS;
    }

    public function setIdS($idS)
    {
        $idS = (int) $idS;
        $this->_idS = $idS;
    }
}