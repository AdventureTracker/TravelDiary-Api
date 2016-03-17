<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $idUser;

    /**
     * @var string
     */
    private $usrFisrtname;

    /**
     * @var string
     */
    private $usrLastname;

    /**
     * @var string
     */
    private $usrEmail;

    /**
     * @var string
     */
    private $usrPassword;

    /**
     * @var \DateTime
     */
    private $usrLastseen;

    /**
     * @var \DateTime
     */
    private $usrCreatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $usrUpdatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $trips;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $devices;

    /**
     * @var \TravelDiary\CoreBundle\Entity\Role
     */
    private $idRole;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->trips = new \Doctrine\Common\Collections\ArrayCollection();
        $this->devices = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set usrFisrtname
     *
     * @param string $usrFisrtname
     *
     * @return User
     */
    public function setUsrFisrtname($usrFisrtname)
    {
        $this->usrFisrtname = $usrFisrtname;

        return $this;
    }

    /**
     * Get usrFisrtname
     *
     * @return string
     */
    public function getUsrFisrtname()
    {
        return $this->usrFisrtname;
    }

    /**
     * Set usrLastname
     *
     * @param string $usrLastname
     *
     * @return User
     */
    public function setUsrLastname($usrLastname)
    {
        $this->usrLastname = $usrLastname;

        return $this;
    }

    /**
     * Get usrLastname
     *
     * @return string
     */
    public function getUsrLastname()
    {
        return $this->usrLastname;
    }

    /**
     * Set usrEmail
     *
     * @param string $usrEmail
     *
     * @return User
     */
    public function setUsrEmail($usrEmail)
    {
        $this->usrEmail = $usrEmail;

        return $this;
    }

    /**
     * Get usrEmail
     *
     * @return string
     */
    public function getUsrEmail()
    {
        return $this->usrEmail;
    }

    /**
     * Set usrPassword
     *
     * @param string $usrPassword
     *
     * @return User
     */
    public function setUsrPassword($usrPassword)
    {
        $this->usrPassword = $usrPassword;

        return $this;
    }

    /**
     * Get usrPassword
     *
     * @return string
     */
    public function getUsrPassword()
    {
        return $this->usrPassword;
    }

    /**
     * Set usrLastseen
     *
     * @param \DateTime $usrLastseen
     *
     * @return User
     */
    public function setUsrLastseen($usrLastseen)
    {
        $this->usrLastseen = $usrLastseen;

        return $this;
    }

    /**
     * Get usrLastseen
     *
     * @return \DateTime
     */
    public function getUsrLastseen()
    {
        return $this->usrLastseen;
    }

    /**
     * Set usrCreatedat
     *
     * @param \DateTime $usrCreatedat
     *
     * @return User
     */
    public function setUsrCreatedat($usrCreatedat)
    {
        $this->usrCreatedat = $usrCreatedat;

        return $this;
    }

    /**
     * Get usrCreatedat
     *
     * @return \DateTime
     */
    public function getUsrCreatedat()
    {
        return $this->usrCreatedat;
    }

    /**
     * Set usrUpdatedat
     *
     * @param \DateTime $usrUpdatedat
     *
     * @return User
     */
    public function setUsrUpdatedat($usrUpdatedat)
    {
        $this->usrUpdatedat = $usrUpdatedat;

        return $this;
    }

    /**
     * Get usrUpdatedat
     *
     * @return \DateTime
     */
    public function getUsrUpdatedat()
    {
        return $this->usrUpdatedat;
    }

    /**
     * Add trip
     *
     * @param \TravelDiary\CoreBundle\Entity\Trip $trip
     *
     * @return User
     */
    public function addTrip(\TravelDiary\CoreBundle\Entity\Trip $trip)
    {
        $this->trips[] = $trip;

        return $this;
    }

    /**
     * Remove trip
     *
     * @param \TravelDiary\CoreBundle\Entity\Trip $trip
     */
    public function removeTrip(\TravelDiary\CoreBundle\Entity\Trip $trip)
    {
        $this->trips->removeElement($trip);
    }

    /**
     * Get trips
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * Add device
     *
     * @param \TravelDiary\CoreBundle\Entity\Device: $device
     *
     * @return User
     */
    public function addDevice(\TravelDiary\CoreBundle\Entity\Device: $device)
    {
        $this->devices[] = $device;

        return $this;
    }

    /**
     * Remove device
     *
     * @param \TravelDiary\CoreBundle\Entity\Device: $device
     */
    public function removeDevice(\TravelDiary\CoreBundle\Entity\Device: $device)
    {
        $this->devices->removeElement($device);
    }

    /**
     * Get devices
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDevices()
    {
        return $this->devices;
    }

    /**
     * Set idRole
     *
     * @param \TravelDiary\CoreBundle\Entity\Role $idRole
     *
     * @return User
     */
    public function setIdRole(\TravelDiary\CoreBundle\Entity\Role $idRole = null)
    {
        $this->idRole = $idRole;

        return $this;
    }

    /**
     * Get idRole
     *
     * @return \TravelDiary\CoreBundle\Entity\Role
     */
    public function getIdRole()
    {
        return $this->idRole;
    }
}

