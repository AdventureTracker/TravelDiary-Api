<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Record
 */
class Record
{
    /**
     * @var integer
     */
    private $idRecord;

    /**
     * @var string
     */
    private $recUuid;

    /**
     * @var \DateTime
     */
    private $recDay;

    /**
     * @var string
     */
    private $recDescription;

    /**
     * @var float
     */
    private $recLatitude;

    /**
     * @var float
     */
    private $recLongitude;

    /**
     * @var float
     */
    private $recAltitude;

    /**
     * @var \DateTime
     */
    private $recCreatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $recUpdatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \TravelDiary\CoreBundle\Entity\Privacy
     */
    private $idPrivacy;

    /**
     * @var \TravelDiary\CoreBundle\Entity\Recordtype
     */
    private $idRecordtype;

    /**
     * @var \TravelDiary\CoreBundle\Entity\Trip
     */
    private $idTrip;


    /**
     * Get idRecord
     *
     * @return integer
     */
    public function getIdRecord()
    {
        return $this->idRecord;
    }

    /**
     * Set recUuid
     *
     * @param string $recUuid
     *
     * @return Record
     */
    public function setRecUuid($recUuid)
    {
        $this->recUuid = $recUuid;

        return $this;
    }

    /**
     * Get recUuid
     *
     * @return string
     */
    public function getRecUuid()
    {
        return $this->recUuid;
    }

    /**
     * Set recDay
     *
     * @param \DateTime $recDay
     *
     * @return Record
     */
    public function setRecDay($recDay)
    {
        $this->recDay = $recDay;

        return $this;
    }

    /**
     * Get recDay
     *
     * @return \DateTime
     */
    public function getRecDay()
    {
        return $this->recDay;
    }

    /**
     * Set recDescription
     *
     * @param string $recDescription
     *
     * @return Record
     */
    public function setRecDescription($recDescription)
    {
        $this->recDescription = $recDescription;

        return $this;
    }

    /**
     * Get recDescription
     *
     * @return string
     */
    public function getRecDescription()
    {
        return $this->recDescription;
    }

    /**
     * Set recLatitude
     *
     * @param float $recLatitude
     *
     * @return Record
     */
    public function setRecLatitude($recLatitude)
    {
        $this->recLatitude = $recLatitude;

        return $this;
    }

    /**
     * Get recLatitude
     *
     * @return float
     */
    public function getRecLatitude()
    {
        return $this->recLatitude;
    }

    /**
     * Set recLongitude
     *
     * @param float $recLongitude
     *
     * @return Record
     */
    public function setRecLongitude($recLongitude)
    {
        $this->recLongitude = $recLongitude;

        return $this;
    }

    /**
     * Get recLongitude
     *
     * @return float
     */
    public function getRecLongitude()
    {
        return $this->recLongitude;
    }

    /**
     * Set recAltitude
     *
     * @param float $recAltitude
     *
     * @return Record
     */
    public function setRecAltitude($recAltitude)
    {
        $this->recAltitude = $recAltitude;

        return $this;
    }

    /**
     * Get recAltitude
     *
     * @return float
     */
    public function getRecAltitude()
    {
        return $this->recAltitude;
    }

    /**
     * Set recCreatedat
     *
     * @param \DateTime $recCreatedat
     *
     * @return Record
     */
    public function setRecCreatedat($recCreatedat)
    {
        $this->recCreatedat = $recCreatedat;

        return $this;
    }

    /**
     * Get recCreatedat
     *
     * @return \DateTime
     */
    public function getRecCreatedat()
    {
        return $this->recCreatedat;
    }

    /**
     * Set recUpdatedat
     *
     * @param \DateTime $recUpdatedat
     *
     * @return Record
     */
    public function setRecUpdatedat($recUpdatedat)
    {
        $this->recUpdatedat = $recUpdatedat;

        return $this;
    }

    /**
     * Get recUpdatedat
     *
     * @return \DateTime
     */
    public function getRecUpdatedat()
    {
        return $this->recUpdatedat;
    }

    /**
     * Set idPrivacy
     *
     * @param \TravelDiary\CoreBundle\Entity\Privacy $idPrivacy
     *
     * @return Record
     */
    public function setIdPrivacy(\TravelDiary\CoreBundle\Entity\Privacy $idPrivacy = null)
    {
        $this->idPrivacy = $idPrivacy;

        return $this;
    }

    /**
     * Get idPrivacy
     *
     * @return \TravelDiary\CoreBundle\Entity\Privacy
     */
    public function getIdPrivacy()
    {
        return $this->idPrivacy;
    }

    /**
     * Set idRecordtype
     *
     * @param \TravelDiary\CoreBundle\Entity\Recordtype $idRecordtype
     *
     * @return Record
     */
    public function setIdRecordtype(\TravelDiary\CoreBundle\Entity\Recordtype $idRecordtype = null)
    {
        $this->idRecordtype = $idRecordtype;

        return $this;
    }

    /**
     * Get idRecordtype
     *
     * @return \TravelDiary\CoreBundle\Entity\Recordtype
     */
    public function getIdRecordtype()
    {
        return $this->idRecordtype;
    }

    /**
     * Set idTrip
     *
     * @param \TravelDiary\CoreBundle\Entity\Trip $idTrip
     *
     * @return Record
     */
    public function setIdTrip(\TravelDiary\CoreBundle\Entity\Trip $idTrip = null)
    {
        $this->idTrip = $idTrip;

        return $this;
    }

    /**
     * Get idTrip
     *
     * @return \TravelDiary\CoreBundle\Entity\Trip
     */
    public function getIdTrip()
    {
        return $this->idTrip;
    }
}

