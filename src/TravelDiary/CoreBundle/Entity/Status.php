<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Status
 */
class Status
{
    /**
     * @var integer
     */
    private $idStatus;

    /**
     * @var string
     */
    private $staCode;

    /**
     * @var string
     */
    private $staDescription;


    /**
     * Get idStatus
     *
     * @return integer
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }

    /**
     * Set staCode
     *
     * @param string $staCode
     *
     * @return Status
     */
    public function setStaCode($staCode)
    {
        $this->staCode = $staCode;

        return $this;
    }

    /**
     * Get staCode
     *
     * @return string
     */
    public function getStaCode()
    {
        return $this->staCode;
    }

    /**
     * Set staDescription
     *
     * @param string $staDescription
     *
     * @return Status
     */
    public function setStaDescription($staDescription)
    {
        $this->staDescription = $staDescription;

        return $this;
    }

    /**
     * Get staDescription
     *
     * @return string
     */
    public function getStaDescription()
    {
        return $this->staDescription;
    }
}

