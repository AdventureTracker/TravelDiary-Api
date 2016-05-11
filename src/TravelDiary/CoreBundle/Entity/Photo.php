<?php

namespace TravelDiary\CoreBundle\Entity;
use TravelDiary\CoreBundle\Helper\BASE64;

/**
 * Photo
 */
class Photo extends ApiEntity{
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
	 * @var string
	 */
	private $phtMIME;

	/**
	 * @var boolean
	 */
	private $phtUploaded;

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
	 * @return string
	 */
	public function getPhtMIME()
	{
		return $this->phtMIME;
	}

	/**
	 * @param string $phtMIME
	 */
	public function setPhtMIME($phtMIME)
	{
		$this->phtMIME = $phtMIME;
	}

	/**
	 * @return boolean
	 */
	public function isPhtUploaded()
	{
		return $this->phtUploaded;
	}

	/**
	 * @param boolean $phtUploaded
	 */
	public function setPhtUploaded($phtUploaded)
	{
		$this->phtUploaded = $phtUploaded;
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

	/**
	 * @return string
	 */
	public function getPhotosDir() {
		$roodDir =  __DIR__ . "/../../../../web/upload/" . $this->getIdRecord()->getIdTrip()->getTrpUUID() . "/";
		if (is_dir($roodDir)) {
			return $roodDir;
		}
		else {
			mkdir($roodDir);
			return $roodDir;
		}
	}

	public function toArray() {
		return [
			'uuid' 		=> $this->getPhtUUID(),
			'data' 		=> BASE64::encodeFile($this->getPhotosDir() . $this->getPhtFilename(), $this->getPhtMIME())
		];
	}
}

