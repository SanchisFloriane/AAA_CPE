<?php
class pathoEntity
{
    private $_idP;
    private $_mer;
    private $_type;
    private $_desc;

    public function __construct($idP, $mer, $type, $desc)
    {
        $this->setIdP($idP);
        $this->setMer($mer);
        $this->setType($type);
        $this->setDesc($desc);
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

    public function getMer()
    {
        return $this->_mer;
    }

    public function setMer($mer)
    {
        if (is_string($mer)) {
            $this->_mer = $mer;
        }
    }

    public function getType()
    {
        return $this->_type;
    }

    public function setType($type)
    {
        if (is_string($type)) {
            $this->_type = $type;
        }
    }

    public function getDesc()
    {
        return $this->_desc;
    }

    public function setDesc($desc)
    {
        if (is_string($desc)) {
            $this->_desc = $desc;
        }
    }
}