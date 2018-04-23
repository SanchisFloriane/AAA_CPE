<?php
class symptomeEntity
{
    private $_idS;
    private $_desc;

    public function __construct($idS,$desc)
    {
        $this->setIdS($idS);
        $this->setDesc($desc);
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