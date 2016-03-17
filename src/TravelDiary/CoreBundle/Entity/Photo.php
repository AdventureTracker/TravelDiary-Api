<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Photo
 */
class Photo
{
    /**
     * @var integer
     */
    private $idPhoto;

    /**
     * @var string
     */
    private $phtUuid;

    /**
     * @var string
     */
    private $phtFilename = '0';

    /**
     * @var \DateTime
     */
    private $phtCreatedat = 'CURRENT_TIMESTAMP';

    /**
     * @var \TravelDiary\CoreBundle\Entity\Record
     */
    private $idRecord;


    /**
     * Get idPhoto
     *
     * @return integer
     */
    public function getIdPhoto()
    {
        return $this->idPhoto;
    }

    /**
     * Set phtUuid
     *
     * @param string $phtUuid
     *
     * @return Photo
     */
    public function setPhtUuid($phtUuid)
    {
        $this->phtUuid = $phtUuid;

        return $this;
    }

    /**
     * Get phtUuid
     *
     * @return string
     */
    public function getPhtUuid()
    {
        return $this->phtUuid;
    }

    /**
     * Set phtFilename
     *
     * @param string $phtFilename
     *
     * @return Photo
     */
    public function setPhtFilename($phtFilename)
    {
        $this->phtFilename = $phtFilename;

        return $this;
    }

    /**
     * Get phtFilename
     *
     * @return string
     */
    public function getPhtFilename()
    {
        return $this->phtFilename;
    }

    /**
     * Set phtCreatedat
     *
     * @param \DateTime $phtCreatedat
     *
     * @return Photo
     */
    public function setPhtCreatedat($phtCreatedat)
    {
        $this->phtCreatedat = $phtCreatedat;

        return $this;
    }

    /**
     * Get phtCreatedat
     *
     * @return \DateTime
     */
    public function getPhtCreatedat()
    {
        return $this->phtCreatedat;
    }

    /**
     * Set idRecord
     *
     * @param \TravelDiary\CoreBundle\Entity\Record $idRecord
     *
     * @return Photo
     */
    public function setIdRecord(\TravelDiary\CoreBundle\Entity\Record $idRecord = null)
    {
        $this->idRecord = $idRecord;

        return $this;
    }

    /**
     * Get idRecord
     *
     * @return \TravelDiary\CoreBundle\Entity\Record
     */
    public function getIdRecord()
    {
        return $this->idRecord;
    }
}

