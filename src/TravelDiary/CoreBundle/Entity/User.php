<?php

namespace TravelDiary\CoreBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 */
class User implements UserInterface, \Serializable
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
	private $usrCreatedat;

	/**
	 * @var \DateTime
	 */
	private $usrUpdatedat;

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
	public function addDevice(\TravelDiary\CoreBundle\Entity\Device $device)
	{
		$this->devices[] = $device;

		return $this;
	}

	/**
	 * Remove device
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Device: $device
	 */
	public function removeDevice(\TravelDiary\CoreBundle\Entity\Device $device)
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

	/**
	 * String representation of object
	 * @link http://php.net/manual/en/serializable.serialize.php
	 * @return string the string representation of the object or null
	 * @since 5.1.0
	 */
	public function serialize()
	{
		return serialize([
			$this->idUser,
			$this->usrEmail,
			$this->usrPassword
		]);
	}

	/**
	 * Constructs the object
	 * @link http://php.net/manual/en/serializable.unserialize.php
	 * @param string $serialized <p>
	 * The string representation of the object.
	 * </p>
	 * @return void
	 * @since 5.1.0
	 */
	public function unserialize($serialized)
	{
		list(
			$this->idUser,
			$this->usrEmail,
			$this->usrPassword
			) = unserialize($serialized);
	}

	/**
	 * Returns the roles granted to the user.
	 *
	 * <code>
	 * public function getRoles()
	 * {
	 *     return array('ROLE_USER');
	 * }
	 * </code>
	 *
	 * Alternatively, the roles might be stored on a ``roles`` property,
	 * and populated in any number of different ways when the user object
	 * is created.
	 *
	 * @return Role|string[] The user roles
	 */
	public function getRoles()
	{
		return [$this->getIdRole()->getRolName()];
	}

	/**
	 * Returns the password used to authenticate the user.
	 *
	 * This should be the encoded password. On authentication, a plain-text
	 * password will be salted, encoded, and then compared to this value.
	 *
	 * @return string The password
	 */
	public function getPassword()
	{
		return $this->usrPassword;
	}

	/**
	 * Returns the salt that was originally used to encode the password.
	 *
	 * This can return null if the password was not encoded using a salt.
	 *
	 * @return string|null The salt
	 */
	public function getSalt()
	{
		return null;
	}

	/**
	 * Returns the username used to authenticate the user.
	 *
	 * @return string The username
	 */
	public function getUsername()
	{
		return $this->usrEmail;
	}

	/**
	 * Removes sensitive data from the user.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 */
	public function eraseCredentials()
	{
		return null;
	}
}

