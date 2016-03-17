<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Trip
 */
class Trip
{
    /**
     * @var integer
     */
    private $idTrip;

    /**
     * @var string
     */
    private $trpUuid;

    /**
     * @var string
     */
    private $trpName;

    /**
     * @var string
     */
    private $trpDestination;

    /**
     * @var string
     */
    private $trpDescription;

    /**
     * @var \DateTime
     */
    private $trpStartdate;

    /**
     * @var \DateTime
     */
    private $trpEstimatedarrival;

    /**
     * @var \DateTime
     */
    private $trpCreatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     */
    private $trpUpdatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \TravelDiary\CoreBundle\Entity\Privacy
     */
    private $idPrivacy;

    /**
     * @var \TravelDiary\CoreBundle\Entity\Status
     */
    private $idStatus;


    /**
     * Get idTrip
     *
     * @return integer
     */
    public function getIdTrip()
    {
        return $this->idTrip;
    }

    /**
     * Set trpUuid
     *
     * @param string $trpUuid
     *
     * @return Trip
     */
    public function setTrpUuid($trpUuid)
    {
        $this->trpUuid = $trpUuid;

        return $this;
    }

    /**
     * Get trpUuid
     *
     * @return string
     */
    public function getTrpUuid()
    {
        return $this->trpUuid;
    }

    /**
     * Set trpName
     *
     * @param string $trpName
     *
     * @return Trip
     */
    public function setTrpName($trpName)
    {
        $this->trpName = $trpName;

        return $this;
    }

    /**
     * Get trpName
     *
     * @return string
     */
    public function getTrpName()
    {
        return $this->trpName;
    }

    /**
     * Set trpDestination
     *
     * @param string $trpDestination
     *
     * @return Trip
     */
    public function setTrpDestination($trpDestination)
    {
        $this->trpDestination = $trpDestination;

        return $this;
    }

    /**
     * Get trpDestination
     *
     * @return string
     */
    public function getTrpDestination()
    {
        return $this->trpDestination;
    }

    /**
     * Set trpDescription
     *
     * @param string $trpDescription
     *
     * @return Trip
     */
    public function setTrpDescription($trpDescription)
    {
        $this->trpDescription = $trpDescription;

        return $this;
    }

    /**
     * Get trpDescription
     *
     * @return string
     */
    public function getTrpDescription()
    {
        return $this->trpDescription;
    }

    /**
     * Set trpStartdate
     *
     * @param \DateTime $trpStartdate
     *
     * @return Trip
     */
    public function setTrpStartdate($trpStartdate)
    {
        $this->trpStartdate = $trpStartdate;

        return $this;
    }

    /**
     * Get trpStartdate
     *
     * @return \DateTime
     */
    public function getTrpStartdate()
    {
        return $this->trpStartdate;
    }

    /**
     * Set trpEstimatedarrival
     *
     * @param \DateTime $trpEstimatedarrival
     *
     * @return Trip
     */
    public function setTrpEstimatedarrival($trpEstimatedarrival)
    {
        $this->trpEstimatedarrival = $trpEstimatedarrival;

        return $this;
    }

    /**
     * Get trpEstimatedarrival
     *
     * @return \DateTime
     */
    public function getTrpEstimatedarrival()
    {
        return $this->trpEstimatedarrival;
    }

    /**
     * Set trpCreatedat
     *
     * @param \DateTime $trpCreatedat
     *
     * @return Trip
     */
    public function setTrpCreatedat($trpCreatedat)
    {
        $this->trpCreatedat = $trpCreatedat;

        return $this;
    }

    /**
     * Get trpCreatedat
     *
     * @return \DateTime
     */
    public function getTrpCreatedat()
    {
        return $this->trpCreatedat;
    }

    /**
     * Set trpUpdatedat
     *
     * @param \DateTime $trpUpdatedat
     *
     * @return Trip
     */
    public function setTrpUpdatedat($trpUpdatedat)
    {
        $this->trpUpdatedat = $trpUpdatedat;

        return $this;
    }

    /**
     * Get trpUpdatedat
     *
     * @return \DateTime
     */
    public function getTrpUpdatedat()
    {
        return $this->trpUpdatedat;
    }

    /**
     * Set idPrivacy
     *
     * @param \TravelDiary\CoreBundle\Entity\Privacy $idPrivacy
     *
     * @return Trip
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
     * Set idStatus
     *
     * @param \TravelDiary\CoreBundle\Entity\Status $idStatus
     *
     * @return Trip
     */
    public function setIdStatus(\TravelDiary\CoreBundle\Entity\Status $idStatus = null)
    {
        $this->idStatus = $idStatus;

        return $this;
    }

    /**
     * Get idStatus
     *
     * @return \TravelDiary\CoreBundle\Entity\Status
     */
    public function getIdStatus()
    {
        return $this->idStatus;
    }
}

