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
	private $devUUID;

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
	private $devCreatedAt = 'CURRENT_TIMESTAMP';

	/**
	 * @var \DateTime
	 */
	private $devUpdatedAt = 'CURRENT_TIMESTAMP';

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
	 * Set devUUID
	 *
	 * @param string $devUUID
	 *
	 * @return Device
	 */
	public function setDevUUID($devUUID)
	{
		$this->devUUID = $devUUID;

		return $this;
	}

	/**
	 * Get devUUID
	 *
	 * @return string
	 */
	public function getDevUUID()
	{
		return $this->devUUID;
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
	 * Set devCreatedAt
	 *
	 * @param \DateTime $devCreatedAt
	 *
	 * @return Device
	 */
	public function setDevCreatedAt($devCreatedAt)
	{
		$this->devCreatedAt = $devCreatedAt;

		return $this;
	}

	/**
	 * Get devCreatedAt
	 *
	 * @return \DateTime
	 */
	public function getDevCreatedAt()
	{
		return $this->devCreatedAt;
	}

	/**
	 * Set devUpdatedAt
	 *
	 * @param \DateTime $devUpdatedAt
	 *
	 * @return Device
	 */
	public function setDevUpdatedAt($devUpdatedAt)
	{
		$this->devUpdatedAt = $devUpdatedAt;

		return $this;
	}

	/**
	 * Get devUpdatedAt
	 *
	 * @return \DateTime
	 */
	public function getDevUpdatedAt()
	{
		return $this->devUpdatedAt;
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

	public function toArray() {
		return [];
	}
}

