<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 27.03.2016
 * Time: 23:22
 */

namespace TravelDiary\CoreBundle\Entity;


class ApiToken
{

	/**
	 * @var int
	 */
	public $idToken;

	/**
	 * @var Device
	 */
	public $idDevice;

	/**
	 * @var string
	 */
	public $tokValue;

	/**
	 * @var \DateTime
	 */
	public $tokLastUsed;

	/**
	 * @var \DateTime
	 */
	public $tokCreatedAt;

	/**
	 * @var \DateTime
	 */
	public $tokUpdatedAt;

	/**
	 * @return int
	 */
	public function getIdToken()
	{
		return $this->idToken;
	}

	/**
	 * @return Device
	 */
	public function getIdDevice()
	{
		return $this->idDevice;
	}

	/**
	 * @param Device $idDevice
	 */
	public function setIdDevice($idDevice)
	{
		$this->idDevice = $idDevice;
	}

	/**
	 * @return string
	 */
	public function getTokValue()
	{
		return $this->tokValue;
	}

	/**
	 * @param string $tokValue
	 */
	public function setTokValue($tokValue)
	{
		$this->tokValue = $tokValue;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokLastUsed()
	{
		return $this->tokLastUsed;
	}

	/**
	 * @param \DateTime $tokLastUsed
	 */
	public function setTokLastUsed($tokLastUsed)
	{
		$this->tokLastUsed = $tokLastUsed;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokCreatedAt()
	{
		return $this->tokCreatedAt;
	}

	/**
	 * @param \DateTime $tokCreatedAt
	 */
	public function setTokCreatedAt($tokCreatedAt)
	{
		$this->tokCreatedAt = $tokCreatedAt;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokUpdatedAt()
	{
		return $this->tokUpdatedAt;
	}

	/**
	 * @param \DateTime $tokUpdatedAt
	 */
	public function setTokUpdatedAt($tokUpdatedAt)
	{
		$this->tokUpdatedAt = $tokUpdatedAt;
	}


}