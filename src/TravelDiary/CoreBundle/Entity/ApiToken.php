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
	public $id_token;

	/**
	 * @var Device
	 */
	public $id_device;

	/**
	 * @var string
	 */
	public $tok_value;

	/**
	 * @var \DateTime
	 */
	public $tok_lastUser;

	/**
	 * @var \DateTime
	 */
	public $tok_createdAt = 'CURRENT_TIMESTAMP';

	/**
	 * @var \DateTime
	 */
	public $tok_updatedAt = 'CURRENT_TIMESTAMP';

	/**
	 * @return int
	 */
	public function getIdToken()
	{
		return $this->id_token;
	}

	/**
	 * @return Device
	 */
	public function getIdDevice()
	{
		return $this->id_device;
	}

	/**
	 * @param Device $id_device
	 */
	public function setIdDevice($id_device)
	{
		$this->id_device = $id_device;
	}

	/**
	 * @return string
	 */
	public function getTokValue()
	{
		return $this->tok_value;
	}

	/**
	 * @param string $tok_value
	 */
	public function setTokValue($tok_value)
	{
		$this->tok_value = $tok_value;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokLastUser()
	{
		return $this->tok_lastUser;
	}

	/**
	 * @param \DateTime $tok_lastUser
	 */
	public function setTokLastUser($tok_lastUser)
	{
		$this->tok_lastUser = $tok_lastUser;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokCreatedAt()
	{
		return $this->tok_createdAt;
	}

	/**
	 * @param \DateTime $tok_createdAt
	 */
	public function setTokCreatedAt($tok_createdAt)
	{
		$this->tok_createdAt = $tok_createdAt;
	}

	/**
	 * @return \DateTime
	 */
	public function getTokUpdatedAt()
	{
		return $this->tok_updatedAt;
	}

	/**
	 * @param \DateTime $tok_updatedAt
	 */
	public function setTokUpdatedAt($tok_updatedAt)
	{
		$this->tok_updatedAt = $tok_updatedAt;
	}


}