<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * UserHaveTrip
 */
class UserHaveTrip
{
	/**
	 * @var integer
	 */
	private $idUserHaveTrip;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\Trip
	 */
	private $idTrip;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\User
	 */
	private $idUser;


	/**
	 * Get idUserHaveTrip
	 *
	 * @return integer
	 */
	public function getIdUserHaveTrip()
	{
		return $this->idUserHaveTrip;
	}

	/**
	 * Set idTrip
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Trip $idTrip
	 *
	 * @return UserHaveTrip
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

	/**
	 * Set idUser
	 *
	 * @param \TravelDiary\CoreBundle\Entity\User $idUser
	 *
	 * @return UserHaveTrip
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

