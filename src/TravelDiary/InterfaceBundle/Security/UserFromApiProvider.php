<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 23:21
 */

namespace TravelDiary\InterfaceBundle\Security;


use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use TravelDiary\ApiClient\ApiClientFactory;

class UserFromApiProvider implements UserProviderInterface {

	private $apiClient;

	/**
	 * UserFromApiProvider constructor.
	 * @param ApiClientFactory $apiClientFactory
	 */
	public function __construct(ApiClientFactory $apiClientFactory) {

		$this->apiClient = $apiClientFactory->create();

	}

	/**
	 * Loads the user for the given username.
	 *
	 * This method must throw UsernameNotFoundException if the user is not
	 * found.
	 *
	 * @param string $username The username
	 *
	 * @return UserInterface
	 *
	 * @throws UsernameNotFoundException if the user is not found
	 */
	public function loadUserByUsername($username) {
		try {
			$uri = sprintf('users/%s', $username);
			$response = $this->apiClient->get($uri);
			$responseArray = json_decode($response->getBody()->getContents(), true);
		}
		catch (ClientException $e) {
			throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
		}

		return UserFromApi::createFromArray($responseArray);

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

		if (!$user instanceof UserFromApi)
			return null;

		try {
			$uri = 'users/me';
			$response = $this->apiClient->get($uri, [
				'headers' => [
					ApiClientFactory::TOKEN_HEADER => $user->getUserApiToken(),
					ApiClientFactory::DEVICE_HEADER => $user->getUserApiSecret()
				]
			]);
			$responseArray = json_decode($response->getBody()->getContents(), TRUE);
			$responseArray['token'] = $user->getUserApiToken();
			$responseArray['secret'] = $user->getUserApiSecret();
			$responseArray['role'] = $user->getRoles();
		}
		catch (ClientException $e) {
			throw new UsernameNotFoundException(sprintf('User "%s" not found.', $user->getUsername()));
		}

		return UserFromApi::createFromArray($responseArray);

	}

	/**
	 * Whether this provider supports the given user class.
	 *
	 * @param string $class
	 *
	 * @return bool
	 */
	public function supportsClass($class)
	{
		return UserFromApi::class === $class;
	}
}