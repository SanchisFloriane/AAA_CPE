<?php
class symptPathoEntity
{
    private $_idS;
    private $_idP;
    private $_aggr;

    public function __construct($idK, $idS, $aggr)
    {
        $this->setIdS($idK);
        $this->setIdP($idS);
        $this->setAggr($aggr);
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

    public function getIdP()
    {
        return $this->_idP;
    }

    public function setIdP($idP)
    {
        $idP = (int) $idP;
        $this->_idP = $idP;
    }

    public function getAggr()
    {
        return $this->_aggr;
    }

    public function setAggr($aggr)
    {
        $aggr = (int) $aggr;
        $this->_aggr = $aggr;
    }
}
