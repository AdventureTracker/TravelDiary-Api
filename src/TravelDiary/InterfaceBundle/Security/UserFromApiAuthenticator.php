<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 23:20
 */

namespace TravelDiary\InterfaceBundle\Security;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Http\Authentication\SimpleFormAuthenticatorInterface;
use TravelDiary\ApiClient\ApiClientFactory;

class UserFromApiAuthenticator implements SimpleFormAuthenticatorInterface {

	/** @var Client */
	protected $apiClient;

	/**
	 * UserFromApiAuthenticator constructor.
	 * @param ApiClientFactory $apiClientFactory
	 */
	public function __construct(ApiClientFactory $apiClientFactory) {
		$this->apiClient = $apiClientFactory->create();
	}

	public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey) {

		if (!$userProvider instanceof UserFromApiProvider)
			throw new \InvalidArgumentException( sprintf('The user provider must be an instance of UserFromApiProvider (%s was given).', get_class($userProvider)));

		try {
			/** @var UserFromApi $user */
			$user = $userProvider->loadUserByUsername($token->getUsername());
		}
		catch (UsernameNotFoundException $e) {
			throw new BadCredentialsException();
		}

		try {
			$response = $this->apiClient->post('users/login', [
				'form_params' => [
					'email' => $token->getUsername(),
					'password' => $token->getCredentials()
				]
			]);

			$response = json_decode($response->getBody()->getContents());

			$user->setUserApiSecret($response['secret']);
			$user->setUserApiToken($response['token']);
			$user->setRoles($response['role']);
		}
		catch (ClientException $e) {
			throw new BadCredentialsException();
		}

		return new UsernamePasswordToken($user, $token->getCredentials(), $providerKey, $user->getRoles());
	}

	/**
	 * @param TokenInterface $token
	 * @param $providerKey
	 * @return bool
	 */
	public function supportsToken(TokenInterface $token, $providerKey) {
		return $token instanceof UsernamePasswordToken && $token->getProviderKey() === $providerKey;
	}

	/**
	 * @param Request $request
	 * @param $username
	 * @param $password
	 * @param $providerKey
	 * @return UsernamePasswordToken
	 * @throws \Symfony\Component\Security\Core\Exception\BadCredentialsException
	 */
	public function createToken(Request $request, $username, $password, $providerKey) {
		if (!$username || !$password)
			throw new BadCredentialsException();

		return new UsernamePasswordToken($username, $password, $providerKey);
	}
}