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
	private $phtUUID;

	/**
	 * @var string
	 */
	private $phtFilename;

	/**
	 * @var \DateTime
	 */
	private $phtCreatedAt;

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
	 * Set phtUUID
	 *
	 * @param string $phtUUID
	 *
	 * @return Photo
	 */
	public function setPhtUUID($phtUUID)
	{
		$this->phtUUID = $phtUUID;

		return $this;
	}

	/**
	 * Get phtUUID
	 *
	 * @return string
	 */
	public function getPhtUUID()
	{
		return $this->phtUUID;
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
	 * Set phtCreatedAt
	 *
	 * @param \DateTime $phtCreatedAt
	 *
	 * @return Photo
	 */
	public function setPhtCreatedAt($phtCreatedAt)
	{
		$this->phtCreatedAt = $phtCreatedAt;

		return $this;
	}

	/**
	 * Get phtCreatedAt
	 *
	 * @return \DateTime
	 */
	public function getPhtCreatedAt()
	{
		return $this->phtCreatedAt;
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

	public function toArray() {
		return [
			'data' 		=> ""
		];
	}
}

