<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 16:30
 */

namespace TravelDiary\InterfaceBundle\Security;


use Symfony\Component\Security\Core\User\UserInterface;

class UserFromApi implements UserInterface
{

	/** @var string */
	private $id;

	/** @var string */
	private $email;

	/** @var string */
	private $firstName;

	/** @var string */
	private $lastName;

	/** @var string */
	private $userApiToken;

	/**
	 * @var string
	 */
	private $userApiSecret;

	/** @var array */
	private $roles = [];

	public function __construct(string $id,string $email, array $roles)
	{
		$this->id = $id;
		$this->email = $email;
		$this->roles = $roles;
	}

	/**
	 * @return string
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName($lastName)
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getUserApiToken()
	{
		return $this->userApiToken;
	}

	/**
	 * @param string $userApiToken
	 */
	public function setUserApiToken($userApiToken)
	{
		$this->userApiToken = $userApiToken;
	}

	/**
	 * @return string
	 */
	public function getUserApiSecret()
	{
		return $this->userApiSecret;
	}

	/**
	 * @param string $userApiSecret
	 */
	public function setUserApiSecret($userApiSecret)
	{
		$this->userApiSecret = $userApiSecret;
	}

	public function getFullName() {
		return sprintf("%s %s", $this->getFirstName(), $this->getLastName());
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
	 * @return mixed (Role|string)[] The user roles
	 */
	public function getRoles()
	{
		return $this->getRoles();
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
		return null;
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
		return $this->email;
	}

	/**
	 * Removes sensitive data from the user.
	 *
	 * This is important if, at any given point, sensitive information like
	 * the plain-text password is stored on this object.
	 */
	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}
}