<?php
class Pathologie
{
    private $idP;
    private $type;
    private $desc;

    private $idMer;
    private $codeMer;
    private $nomMer;
    private $yinMer;

    private $motcles;
    private $symptomes;

    /**
     * Pathologie constructor.
     */
    public function __construct($array)
    {
        foreach ($array as $k=>$v) {
            $setter="set".ucfirst($k);
            $this->$setter($v);
        }

    }

    /**
     * @return mixed
     */
    public function getIdP()
    {
        return $this->idP;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getIdMer()
    {
        return $this->idMer;
    }

    /**
     * @return mixed
     */
    public function getNomMer()
    {
        return $this->nomMer;
    }

    /**
     * @return mixed
     */
    public function getYinMer()
    {
        return $this->yinMer;
    }

    /**
     * @return mixed
     */
    public function getMotcles()
    {
        return $this->motcles;
    }

    /**
     * @return mixed
     */
    public function getSymptomes()
    {
        return $this->symptomes;
    }

    /**
     * @param mixed $idP
     */
    public function setIdP($idP)
    {
        $this->idP = $idP;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
    }

    /**
     * @param mixed $idMer
     */
    public function setIdMer($idMer)
    {
        $this->idMer = $idMer;
    }

    /**
     * @param mixed $nomMer
     */
    public function setNomMer($nomMer)
    {
        $this->nomMer = $nomMer;
    }

    /**
     * @param mixed $yinMer
     */
    public function setYinMer($yinMer)
    {
        $this->yinMer = $yinMer;
    }

    /**
     * @param mixed $motcles
     */
    public function setMotcles($motcles)
    {
        $this->motcles = $motcles;
    }

    /**
     * @param mixed $symptomes
     */
    public function setSymptomes($symptomes)
    {
        $this->symptomes = $symptomes;
    }


    /**
     * @return mixed
     */
    public function getCodeMer()
    {
        return $this->codeMer;
    }

    /**
     * @param mixed $codeMer
     */
    public function setCodeMer($codeMer)
    {
        $this->codeMer = $codeMer;
    }

}