<?php
class meridienEntity
{
    private $_code;
    private $_nom;
    private $_element;
    private $_yin;

    public function __construct($idK, $idS)
    {
        $this->setCode($idK);
        $this->setNom($idS);
        $this->setElement($idS);
        $this->setYin($idS);
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function setCode($code)
    {
        if (is_string($code)) {
            $this->_code = $code;
        }
    }

    public function getNom()
    {
        return $this->_nom;
    }

    public function setNom($nom)
    {
        if (is_string($nom)) {
            $this->_nom = $nom;
        }
    }

    public function getElement()
    {
        return $this->_element;
    }

    public function setElement($element)
    {
        if (is_string($element)) {
            $this->_element = $element;
        }
    }

    public function getYin()
    {
        return $this->_yin;
    }

    public function setYin($yin)
    {
        $yin = (int)$yin;
        $this->_yin = $yin;
    }
}