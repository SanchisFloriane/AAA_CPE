<?php
class meridienEntity
{
    private $_code;
    private $_nom;
    private $_element;
    private $_yin;

    public function __construct($code, $nom, $element, $yin)
    {
        $this->setCode($code);
        $this->setNom($nom);
        $this->setElement($element);
        $this->setYin($yin);
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