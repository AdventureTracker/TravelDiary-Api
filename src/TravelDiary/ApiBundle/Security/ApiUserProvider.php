<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 28.03.2016
 * Time: 15:18
 */

namespace TravelDiary\ApiBundle\Security;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiUserProvider implements UserProviderInterface
{

	/**
	 * @var EntityManager
	 */
	private $em;

	public function __construct(EntityManager $entityManager)
	{
		$this->em = $entityManager;
	}

	/**
	 * Loads the user for the given username.
	 *
	 * This method must throw UsernameNotFoundException if the user is not
	 * found.
	 *
	 * @param string $apiToken
	 * @return UserInterface
	 * @internal param string $username The username
	 *
	 */
	public function loadUserByUsername($apiToken)
	{
		$tokenEntity = $this->em->getRepository("TravelDiaryCoreBundle:ApiToken")->findOneBy([
			'tokValue' 			=> $apiToken
		]);

		if (!$tokenEntity)
			throw new UsernameNotFoundException();

		$tokenEntity->setTokLastUsed(new \DateTime());
		$this->em->persist($tokenEntity);
		$this->em->flush();

		return $tokenEntity->getIdDevice()->getIdUser();
	}

	/**
	 * Refreshes the user for the account interface.
	 *
	 * It is up to the implementation to decide if the user data should be
	 * totally reloaded (e.g. from the database), or if the UserInterface
	 * object can just be merged into some internal array of users / identity
	 * map.
	 *
	 * @param UserInterface $user
	 *
	 * @return UserInterface
	 *
	 * @throws UnsupportedUserException if the account is not supported
	 */
	public function refreshUser(UserInterface $user) {
		throw new UnsupportedUserException();
	}

	/**
	 * Whether this provider supports the given user class.
	 *
	 * @param string $class
	 *
	 * @return bool
	 */
	public function supportsClass($class) {
		return 'TravelDiary\CoreBundle\Entity\User' === $class;
	}
}