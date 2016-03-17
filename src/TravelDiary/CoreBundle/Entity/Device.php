<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Device
 */
class Device
{
    /**
     * @var integer
     */
    private $idDevice;

    /**
     * @var string
     */
    private $devUuid;

    /**
     * @var string
     */
    private $devVersion;

    /**
     * @var string
     */
    private $devOs;

    /**
     * @var \DateTime
     */
    private $devCreatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $devUpdatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \TravelDiary\CoreBundle\Entity\User
     */
    private $idUser;


    /**
     * Get idDevice
     *
     * @return integer
     */
    public function getIdDevice()
    {
        return $this->idDevice;
    }

    /**
     * Set devUuid
     *
     * @param string $devUuid
     *
     * @return Device
     */
    public function setDevUuid($devUuid)
    {
        $this->devUuid = $devUuid;

        return $this;
    }

    /**
     * Get devUuid
     *
     * @return string
     */
    public function getDevUuid()
    {
        return $this->devUuid;
    }

    /**
     * Set devVersion
     *
     * @param string $devVersion
     *
     * @return Device
     */
    public function setDevVersion($devVersion)
    {
        $this->devVersion = $devVersion;

        return $this;
    }

    /**
     * Get devVersion
     *
     * @return string
     */
    public function getDevVersion()
    {
        return $this->devVersion;
    }

    /**
     * Set devOs
     *
     * @param string $devOs
     *
     * @return Device
     */
    public function setDevOs($devOs)
    {
        $this->devOs = $devOs;

        return $this;
    }

    /**
     * Get devOs
     *
     * @return string
     */
    public function getDevOs()
    {
        return $this->devOs;
    }

    /**
     * Set devCreatedat
     *
     * @param \DateTime $devCreatedat
     *
     * @return Device
     */
    public function setDevCreatedat($devCreatedat)
    {
        $this->devCreatedat = $devCreatedat;

        return $this;
    }

    /**
     * Get devCreatedat
     *
     * @return \DateTime
     */
    public function getDevCreatedat()
    {
        return $this->devCreatedat;
    }

    /**
     * Set devUpdatedat
     *
     * @param \DateTime $devUpdatedat
     *
     * @return Device
     */
    public function setDevUpdatedat($devUpdatedat)
    {
        $this->devUpdatedat = $devUpdatedat;

        return $this;
    }

    /**
     * Get devUpdatedat
     *
     * @return \DateTime
     */
    public function getDevUpdatedat()
    {
        return $this->devUpdatedat;
    }

    /**
     * Set idUser
     *
     * @param \TravelDiary\CoreBundle\Entity\User $idUser
     *
     * @return Device
     */
    public function setIdUser(\TravelDiary\CoreBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \TravelDiary\CoreBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }
}

